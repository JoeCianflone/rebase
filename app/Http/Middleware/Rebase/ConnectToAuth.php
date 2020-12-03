<?php

namespace App\Http\Middleware\Rebase;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Rebase\HostHelper;
use App\Http\Middleware\BaseMiddleware;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\LookupRepository;

class ConnectToAuth extends BaseMiddleware
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
        if ($this->shouldIgnore($request->path()) || $host->getSlug() !== config('rebase.subdomains.auth')) {
            return $next($request);
        }

        try {
            if ($request->query('customer_id') !== 'null' && !is_null($request->query('customer_id'))) {
                $lookup = LookupRepository::query()->getByCustomerID($request->query('customer_id'));
            } elseif ($request->query('to') !== 'null' && !is_null($request->query('to'))) {
                $lookup = LookupRepository::query()->getBySlug($request->query('to'));
            } else {
                throw new \Exception('Unable to lookup via query');
            }

            WorkspaceDatabase::disconnect();
            WorkspaceDatabase::connect($lookup->customer_id);

            $request->merge([
                'customer_id' => $lookup->customer_id,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('search.index')->withMessage('Please find your website sign in');
        }

        return $next($request);
    }
}
