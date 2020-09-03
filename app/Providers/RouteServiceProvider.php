<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapRoutes('web');
    }

    /**
     * @param null|string ...$middleware
     */
    private function mapRoutes(?string ...$middleware): void
    {
        foreach (glob(base_path('routes/*.php')) as $file) {
            Route::middleware($middleware)
                ->namespace($this->namespace)
                ->group($file);
        }
    }

    /**
     * @param null|string ...$middleware
     */
    private function explicitRoutes(string $routePath, ?string ...$middleware): void
    {
        Route::middleware($middleware)
            ->namespace($this->namespace)
            ->group(base_path($routePath));
    }
}
