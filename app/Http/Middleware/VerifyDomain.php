<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\DBHelper;
use App\Exceptions\DomainNotFoundException;
use App\Domain\Repositories\Facades\TenantRepository;

class VerifyDomain extends BaseMiddleware
{
    protected $except = [
        'storage',
        'storage/*',
        'register',
        'register/*',
        'horizon',
        'horizon/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->shouldIgnore($request->path())) {
            return $next($request);
        }

        try {
            $slug = $this->getTLD($request);
            $tenant = TenantRepository::getBySlug($slug);
            $domain = config('app.domain');

            $connection = new DBHelper($tenant->id);
            $connection->purgeConnection();
            $connection->connect();

            session([
                'workspace' => $tenant->slug,
                'workspace_url' => "https://{$tenant->slug}.{$domain}"
            ]);
        } catch (DomainNotFoundException $e) {
            session()->flush();
            session([
                'workspace' => null,
                'workspace_url' => null
            ]);

            return Redirect::route('shared.get.index.register')
                             ->with('message', "Good News! That site is available to register")
                             ->with('slug', $slug);
        }
    }
}
