<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],

        'App\Events\NewAccountCreated' => [
            'App\Listeners\CreateWorkspace',
            'App\Listeners\SendNewAccountWelcome',
        ],

        'App\Events\WorkspaceCreated' => [
            'App\Listeners\AddAccountAdmin',
            'App\Listeners\SendWorkspaceCreatedEmail',
            'App\Listeners\SendSuperAdminNewWorkspaceEmail',
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
