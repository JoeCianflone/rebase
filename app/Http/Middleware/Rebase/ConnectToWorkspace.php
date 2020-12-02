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
            $lookup = $this->getLookupInfo($host, $request);

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

    private function lookupAuth(Request $request)
    {
        if ($request->query('to') === 'null' || is_null($request->query('to'))) {
            return LookupRepository::query()->getByCustomerID($request->query('customer_id'));
        }

        return LookupRepository::query()->getBySlug($request->query('to'));
    }

    private function lookupAdmin(string $path)
    {
        return LookupRepository::query()->getByCustomerID($path);
    }

    private function getLookupInfo(HostHelper $host, Request $request)
    {
        $lookup = null;
        if ($host->getSlug() === config('rebase.subdomains.auth')) {
            $lookup = $this->lookupAuth($request);
        } elseif ($host->getSlug() === config('rebase.subdomains.admin') && is_null($lookup)) {
            $lookup = $this->lookupAdmin($host->getPath()[0]);
        }

        if (is_null($lookup)) {
            $lookup = $host->isCustomDomain() ? LookupRepository::query()->getByDomain($host->getDomain()) : LookupRepository::query()->getBySlug($host->getSlug());
        }

        return $lookup;
    }
}
