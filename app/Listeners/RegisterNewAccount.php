<?php

namespace App\Listeners;

use App\Events\StartAccountSignup;
use Illuminate\Contracts\Queue\ShouldQueue;

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
    }
}
