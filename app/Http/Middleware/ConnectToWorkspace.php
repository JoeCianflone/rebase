<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\HostHelper;
use Illuminate\Http\Request;
use App\Domain\Facades\WorkspaceRepository;
use App\Helpers\WorkspaceConnectionManager;

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
        'horizon/api',
        'horizon/api/*',
        'horizon/api/batches',
        'horizon/api/batches/retry',
        'horizon/api/batches/retry/*',
        'horizon/api/batches',
        'horizon/api/batches/*',
        'horizon/api/jobs/completed',
        'horizon/api/jobs/failed',
        'horizon/api/jobs/failed/*',
        'horizon/api/jobs/pending',
        'horizon/api/jobs/retry/*',
        'horizon/api/jobs',
        'horizon/api/jobs/*',
        'horizon/api/masters',
        'horizon/api/metrics/jobs',
        'horizon/api/metrics/jobs/*',
        'horizon/api/metrics/queues',
        'horizon/api/metrics/queues/*',
        'horizon/api/monitoring',
        'horizon/api/monitoring/*',
        'horizon/api/monitoring',
        'horizon/api/monitoring/*',
        'horizon/api/stats',
        'horizon/api/workload',
        'register/*',
        '_debugbar/assets',
        '_debugbar/assets/*',
        '_debugbar',
        '_debugbar/*',
        'stripe/*',
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

            return redirect()->route('view.register.workspace');
        }

        return $next($request);
    }
}
