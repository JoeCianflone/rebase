<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Rebase\HostHelper;
use App\Http\Middleware\BaseMiddleware;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\LookupRepository;

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
            WorkspaceDatabase::disconnect();

            return $next($request);
        }

        $host = new HostHelper($request);

        try {
            if ($host->getSlug() === 'my') {
                $lookup = LookupRepository::query()->getByCustomerID($host->getPath()[0]);
            } else {
                $lookup = $host->isCustomDomain() ? LookupRepository::query()->getByDomain($host->getDomain()) : LookupRepository::query()->getBySlug($host->getSlug());
            }

            WorkspaceDatabase::disconnect();
            WorkspaceDatabase::connect($lookup->customer_id);

            if ($host->isCustomDomain()) {
                $request->merge([
                    'domain' => $host->getDomain(),
                ]);
            }

            $request->merge([
                'workspace_id' => $lookup->workspace_id,
                'customer_id' => $lookup->customer_id,
                'slug' => $lookup->slug,
                'url' => $host->getURL(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('register.index');
        }

        return $next($request);
    }
}
