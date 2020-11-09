<?php

namespace App\Providers;

use App\Actions\Action;
use Carbon\CarbonImmutable;
use Laravel\Cashier\Cashier;
use App\Actions\Rebase\GetView;
use App\Actions\Rebase\ActiveRole;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Actions\Rebase\GetWorkspaceName;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Cashier::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);

        Blade::component('emails.text', 'text');
        Blade::component('emails.headline', 'headline');
        Blade::component('emails.divider', 'divider');

        Action::init([
            'getView' => GetView::class,
            'getWorkspaceName' => GetWorkspaceName::class,
            'activeRole' => ActiveRole::class,
        ]);
    }
}
