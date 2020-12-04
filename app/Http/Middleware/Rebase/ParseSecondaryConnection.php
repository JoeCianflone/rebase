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
        'search',
    ];

    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $host = new HostHelper($request);
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            WorkspaceDatabase::disconnect();

            if ($host->getSlug() === config('rebase.subdomains.auth')) {
                $lookup = $this->connectFromAuthSubdomain($request);
            } elseif ($host->getSlug() === config('rebase.subdomains.admin')) {
                $lookup = $this->connectFromAdminSubdomain($host->getPath()[0]);
            } else {
                $lookup = $this->connectFromWorkspace($host);
                if ($host->isCustomDomain()) {
                    $request->merge([
                        'domain' => $host->getDomain(),
                    ]);
                }

                $request->merge([
                    'workspace_id' => $lookup->workspace_id,
                    'slug' => $lookup->slug,
                    'url' => $host->getURL(),
                ]);
            }

            $request->merge([
                'customer_id' => $lookup->customer_id,
            ]);

            WorkspaceDatabase::connect($lookup->customer_id);
        } catch (SubdomainConnectionException $e) {
            return redirect()->route('search.index')->withMessage('We can\'t find the page you\'re looking for, try searching for your website and logging in first');
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

        if (is_null($lookup)) {
            throw new SubdomainConnectionException('Connect from Auth Failed');
        }

        return $lookup;
    }

    private function connectFromAdminSubdomain(?string $path = null)
    {
        if (is_null($path) || $path === '') {
            throw new SubdomainConnectionException('Connect from Admin Failed');
        }

        $lookup = LookupRepository::query()->getByCustomerID($path)->first();
        if (is_null($lookup)) {
            throw new SubdomainConnectionException('Connect from Admin Failed');
        }

        return $lookup;
    }

    private function connectFromWorkspace($host)
    {
        $lookup = $host->isCustomDomain() ? LookupRepository::query()->getByDomain($host->getDomain())->first() : LookupRepository::query()->getBySlug($host->getSlug())->first();

        if (is_null($lookup)) {
            throw new SubdomainConnectionException('Connect from Auth Failed');
        }

        return $lookup;
    }
}
