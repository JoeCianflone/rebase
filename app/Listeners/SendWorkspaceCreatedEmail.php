<?php

namespace App\Listeners;

use App\Events\AccountReady;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWorkspaceCreatedEmail implements ShouldQueue
{
    public string $queue = 'email';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(AccountReady $event): void
    {
    }
}
