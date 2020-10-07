<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\HostHelper;
use Illuminate\Http\Request;
use App\Helpers\WorkspaceDatabase;
use App\Domain\Facades\WorkspaceRepository;

class ConnectToWorkspace extends BaseMiddleware
{
    /**
     * @var array<string>
     */
    protected array $except = [
        'storage',
        'horizon',
        'register',
        '_debugbar',
        'stripe',
        'design',
    ];

    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        $host = new HostHelper($request->getHost());

        try {
            $workspace = $host->isCustomDomain() ? WorkspaceRepository::getByDomain($host->getDomain()) : WorkspaceRepository::getBySlug($host->getSlug());

            WorkspaceDatabase::disconnect();
            WorkspaceDatabase::connect($workspace->id);

            if ($host->isCustomDomain()) {
                config([
                    'session.domain' => $host->getDomain(),
                ]);
            }

            session([
                'workspace_id' => $workspace->id,
                'workspace_slug' => $workspace->slug,
                'workspace_url' => $host->getURL(),
            ]);
        } catch (\Exception $e) {
            // Just redirect to the registration page, in app you should send a message or do something if this happens

            return redirect()->route('check-workspace.index');
        }

        return $next($request);
    }
}
