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
     */
    public function register(): void
    {
        Inertia::version(fn (): ?string => md5_file(public_path('mix-manifest.json')) ?: null);

        Inertia::share('auth.user', function () {
            if (Auth::user()) {
                return [
                    'id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ];
            }
        });

        Inertia::share([
            'app' => [],
            'flash' => [
                'success' => fn (): ?string => Session::get('success'),
                'alert' => fn (): ?string => Session::get('alert'),
                'message' => fn (): ?string => Session::get('message'),
            ],
            'errors' => function () {
                return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) [];
            },
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
