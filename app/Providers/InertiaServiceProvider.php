<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Inertia::version(function (): ?string {
            return md5_file(public_path('mix-manifest.json')) ?: null;
        });

        Inertia::share([
            'auth' => function (): array {
                return [
                    'user' => auth()->user() ? [
                        'id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'email' => auth()->user()->email,
                    ] : null,
                ];
            },
            'app' => function (): array {
                return [
                    'name' => Config::get('app.name'),
                    'domain' => Config::get('app.domain'),
                    'pricing' => Config::get('pricing.product.test'),
                ];
            },
            'flash' => function (): array {
                return [
                    'success' => Session::get('success'),
                    'alert' => Session::get('alert'),
                    'message' => Session::get('message'),
                ];
            },

            'errors' => function (): array {
                return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : [];
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
