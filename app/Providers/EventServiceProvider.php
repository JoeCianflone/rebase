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
        'App\Events\Rebase\StartCustomerSignup' => [
            'App\Listeners\Rebase\CreateNewCustomer',
        ],

        'App\Events\Rebase\FailedCustomerSignup' => [
            'App\Listeners\Rebase\SendCustomerAlert',
            'App\Listeners\Rebase\SendSuperAdminAlert',
        ],

        'App\Events\Rebase\FinishedCustomerSignup' => [
            'App\Listeners\Rebase\SendCustomerWelcomeEmail',
            'App\Listeners\Rebase\SendSuperAdminEmail',
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
