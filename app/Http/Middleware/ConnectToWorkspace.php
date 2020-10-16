<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\HostHelper;
use Illuminate\Http\Request;
use App\Helpers\WorkspaceDatabase;
use App\Domain\Repositories\Facades\LookupRepository;

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
        'grid',
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
            $lookup = $host->isCustomDomain() ? LookupRepository::whereByDomain($host->getDomain()) : LookupRepository::whereBySlug($host->getSlug());

            WorkspaceDatabase::disconnect();
            WorkspaceDatabase::connect($lookup->customer_id);

            if ($host->isCustomDomain()) {
                config([
                    'session.domain' => $host->getDomain(),
                ]);
            }

            session([
                'workspace_id' => $lookup->workspace_id,
                'customer_id' => $lookup->customer_id,
                'slug' => $lookup->slug,
                'url' => $host->getURL(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('check-workspace.index');
        }

        return $next($request);
    }
}
