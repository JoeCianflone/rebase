<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\HostHelper;
use Illuminate\Http\Request;
use App\Helpers\WorkspaceConnectionManager;
use App\Domain\Repositories\Facades\WorkspaceRepository;

class ConnectToWorkspace extends BaseMiddleware
{
    /**
     * @var array<string>
     */
    protected array $except = [
        'storage',
        'storage/*',
        'horizon',
        'horizon/*',
    ];

    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $host = new HostHelper($request->getHost());
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            $workspace = $host->isCustomDomain() ? WorkspaceRepository::getByDomain($host->getDomain()) : WorkspaceRepository::getBySlug($host->getSlug());

            WorkspaceConnectionManager::disconnect();
            WorkspaceConnectionManager::connect($workspace->id);

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
            return redirect()->route('view.registration');
        }

        return $next($request);
    }
}
