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
        'App\Events\StartCustomerSignup' => [
            'App\Listeners\CreateNewCustomer',
        ],

        'App\Events\FailedCustomerSignup' => [
            'App\Listeners\SendCustomerAlert',
            'App\Listeners\SendSuperAdminAlert',
        ],

        'App\Events\FinishedCustomerSignup' => [
            'App\Listeners\SendCustomerWelcomeEmail',
            'App\Listeners\SendSuperAdminEmail',
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
