<?php

namespace App\Providers;

use App\Helpers\QueryCache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
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
