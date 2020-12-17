<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Enums\Rebase\MemberRoles;
use App\Domain\Facades\Rebase\RoleRepository;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @return null|string
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'customer_id' => $request->query('customer_id') ?? $request->get('customer_id'),
            'auth' => function () use ($request): array {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                        'roles' => auth()->user()->roles->mapToWorkspace(),
                    ] : null,
                ];
            },
            'app' => function (): array {
                return [
                    'name' => config('app.name'),
                    'domain' => config('app.domain'),
                    'pricing' => config('pricing.product.test'),
                    'roles' => Arr::except(MemberRoles::toArray(), ['SUPER']),
                ];
            },
            'flash' => function (): array {
                return [
                    'success' => session('success'),
                    'alert' => session('alert'),
                    'message' => session('message'),
                    'errors' => session('errors'),
                ];
            },
        ]);
    }
}
