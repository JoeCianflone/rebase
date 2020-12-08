<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Rebase\HostHelper;
use App\Http\Middleware\BaseMiddleware;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\LookupRepository;
use App\Exceptions\SubdomainConnectionException;

class ParseSecondaryConnection extends BaseMiddleware
{

    protected array $except = [
        'storage',
        'horizon',
        'register',
        '_debugbar',
        'stripe',
        'design',
        'grid',
        'search',
    ];

    public function handle(Request $request, Closure $next): mixed
    {
        $host = new HostHelper(
            host: $request->getHost(),
            hostParts: explode('.', $request->getHost()),
            path: ltrim($request->getPathInfo(), '/'),
        );

        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            WorkspaceDatabase::disconnect();

            $lookup = match ($host->getSlug()) {
                config('rebase.subdomains.auth') => $this->connectFromAuthSubdomain($request),
                config('rebase.subdomains.admin') => $this->connectFromAdminSubdomain($host->getPath()[0]),
                default => $this->connectFromWorkspace($host)
            };

            if (is_null($lookup)) {
                throw new SubdomainConnectionException('Unable to find the site you are trying to connect to, please try searching for it instead');
            }

            if ($host->isCustomDomain()) {
                $request->merge([
                    'domain' => $host->getDomain(),
                ]);
            }

            $request->merge([
                'customer_id' => $lookup->customer_id,
                'workspace_id' => $lookup->workspace_id,
                'slug' => $lookup->slug,
            ]);

            WorkspaceDatabase::connect($lookup->customer_id);
        } catch (SubdomainConnectionException $e) {
            return redirect()->route('search.index')->with('message', $e->getMessage());
        }

        return $next($request);
    }

    private function connectFromAuthSubdomain($request)
    {
        $lookup = null;

        if ($request->query('customer_id') !== 'null' && !is_null($request->query('customer_id'))) {
            $lookup = LookupRepository::query()->getByCustomerID($request->query('customer_id'))->first();
        }

        if ($request->query('to') !== 'null' && !is_null($request->query('to'))) {
            $lookup = LookupRepository::query()->getBySlug($request->query('to'))->first();
        }

        return $lookup;
    }

    private function connectFromAdminSubdomain(?string $path = null)
    {
        return LookupRepository::query()->getByCustomerID($path)->first();
    }

    private function connectFromWorkspace($host)
    {
        return $host->isCustomDomain() ? LookupRepository::query()->getByDomain($host->getDomain())->first() : LookupRepository::query()->getBySlug($host->getSlug())->first();
    }
}
