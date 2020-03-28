<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::version(fn(): ?string => md5_file(public_path('mix-manifest.json')) ?: null );

        // Inertia::share('auth.user', function () {
        //     if (Auth::user()) {
        //         return [
        //             'id' => Auth::user()->id,
        //             'name' => Auth::user()->name,
        //             'email' => Auth::user()->email,
        //         ];
        //     }
        // });

        Inertia::share([
            'app' => [],
            'flash' => [
                'success' => fn(): Session => Session::get('success'),
                'alert'   => fn(): Session => Session::get('alert'),
                'message' => fn(): Session => Session::get('message'),
            ],
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
