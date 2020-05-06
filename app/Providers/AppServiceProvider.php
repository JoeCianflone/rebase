<?php

namespace App\Providers;

use App\Helpers\QueryCache;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Date::use(CarbonImmutable::class);

        Blade::component('emails.text', 'text');
        Blade::component('emails.headline', 'headline');
        Blade::component('emails.divider', 'divider');

        $this->app->singleton('QueryCache', function ($app) {
            $key = Session::get('workspace_id') ?? Session::getId();

            return new QueryCache($key);
        });
    }
}
