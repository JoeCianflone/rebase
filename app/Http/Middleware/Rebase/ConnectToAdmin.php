<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Rebase\HostHelper;
use App\Http\Middleware\BaseMiddleware;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\LookupRepository;

class ConnectToAdmin extends BaseMiddleware
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
        $host = new HostHelper($request);

        if ($this->shouldIgnore($request->path()) || !$host->getSlug() !== config('rebase.subdomains.admin')) {
            return $next($request);
        }

        try {
            $lookup = LookupRepository::query()->getByCustomerID($host->getPath()[0]);

            WorkspaceDatabase::disconnect();
            WorkspaceDatabase::connect($lookup->customer_id);

            $request->merge([
                'customer_id' => $lookup->customer_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('search.index')->withMessage('Please find your website to sign in ');
        }

        return $next($request);
    }
}
