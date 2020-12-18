<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Helpers\Rebase\HostHelper;
use Illuminate\Support\Facades\Cache;
use App\Http\Middleware\BaseMiddleware;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Models\Rebase\Admin\Lookup;
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
        'search',
    ];

    public function handle(Request $request, Closure $next): mixed
    {
        $host = new HostHelper(
            host: $request->getHost(),
            path: $request->getPathInfo(),
        );

        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            WorkspaceDatabase::disconnect();

            $lookup = match ($host->getSlug()) {
                config('rebase.subdomains.auth') => $this->connectFromAuthSubdomain($request),
                config('rebase.subdomains.admin') => Lookup::byCustomerID($host->getPath()[0])->first(),
                default => $this->connectFromWorkspace($host)
            };

            if (is_null($lookup)) {
                throw new SubdomainConnectionException('Unable to find the site you are trying to connect to, please try searching for it instead');
            }

            $request->merge([
                'customer_id' => $lookup->customer_id,
                'workspace_id' => $lookup->workspace_id,
                'slug' => $lookup->slug,
                'domain' => $host->getDomain(),
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
            $lookup = Lookup::byCustomerID($request->query('customer_id'))->first();
        }

        if ($request->query('to') !== 'null' && !is_null($request->query('to'))) {
            $lookup = Cache::remember('lookup-slug', 300, fn() => Lookup::bySlug($request->query('to'))->first());
        }

        return $lookup;
    }


    private function connectFromWorkspace($host)
    {
        return match($host->isCustomDomain()) {
            true => Lookup::byDomain($host->getDomain())->first(),
            false => Lookup::bySlug($host->getSlug())->first()
        };
    }

}

