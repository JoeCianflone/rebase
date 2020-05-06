<?php

namespace App\Http\Middleware;

use App\Domain\Repositories\Facades\ListingRepository;
use App\Exceptions\DomainNotFoundException;
use App\Helpers\DBWorkspace;
use Closure;
use Illuminate\Http\Request;

class WorkspaceSetup extends BaseMiddleware
{
    protected array $except = [
        'storage',
        'storage/*',
        'register',
        'register/*',
        'horizon',
        'horizon/*',
    ];

    private bool $checkByDomain = false;

    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            $workspace = $this->getWorkspaceFromURI($request->getHost());

            if ($this->checkByDomain) {
                $listing = ListingRepository::getByDomain($workspace);
                config(['session.domain' => $workspace]);
                $workspaceURL = "https://{$workspace}";
            } else {
                $listing = ListingRepository::getBySlug($workspace);
                $workspaceURL = "https://{$workspace}.".config('app.domain');
            }

            DBWorkspace::connect($listing->workspace_id);

            session([
                'workspace_id' => $listing->workspace_id,
                'workspace_slug' => $listing->slug,
                'workspace_url' => $workspaceURL,
            ]);
        } catch (DomainNotFoundException $e) {
            session()->flush();
            session([
                'workspace_id' => null,
                'workspace_slug' => null,
                'workspace_url' => null,
            ]);

            // return Redirect::route('shared.get.index.register')
            //                  ->with('message', "Good News! That site is available to register")
            //                  ->with('slug', $slug);
        }

        return $next($request);
    }

    private function getWorkspaceFromURI(string $hostname): string
    {
        $host = explode('.', $hostname);

        if ($this->isUsingCustomDomain($host)) {
            $this->checkByDomain = true;

            return $this->getCustomDomainName($host);
        }

        // return subdomain...
        return $host[0];
    }

    private function isUsingCustomDomain(array $parts): bool
    {
        return count($parts) <= 2 || 'www' === strtolower($parts[0]);
    }

    private function getCustomDomainName(array $host): string
    {
        if ('www' === strtolower($host[0])) {
            return "{$host[1]}.{$host[2]}";
        }

        return "{$host[0]}.{$host[1]}";
    }
}
