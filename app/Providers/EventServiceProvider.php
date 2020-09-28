<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\StartAccountSignup' => [
            'App\Listeners\RegisterNewAccount',
        ],

        'App\Events\ErrorAccountSignup' => [
            'App\Listeners\AlertSuperAdminEmail',
        ],

        'App\Events\FinishedAccountSignup' => [
            'App\Listeners\SendAccountWelcomeEmail',
            'App\Listeners\AlertSuperAdminEmail',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
