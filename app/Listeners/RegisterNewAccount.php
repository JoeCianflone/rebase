<?php

namespace App\Listeners;

use App\Events\StartAccountSignup;
use Illuminate\Contracts\Pipeline\Pipeline;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Registration\CreateNewDatabase;
use App\Services\Registration\CreateFirstAdministrator;
use App\Services\Registration\CreateNewAccountAndSubscription;

class RegisterNewAccount implements ShouldQueue
{
    public string $queue = 'general';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(StartAccountSignup $event): void
    {
        $steps = [
            CreateNewAccountAndSubscription::class,
            CreateNewDatabase::class,
            CreateFirstAdministrator::class,
            CreateNewWorkspace::class,
        ];

        $pipeline = app(Pipeline::class)
            ->send($event['cart'])
            ->through($steps)
            ->thenReturn();
    }
}
