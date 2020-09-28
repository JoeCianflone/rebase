<?php

namespace App\Listeners;

use App\Events\FinishedAccountSignup;

class AlertSuperAdminEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(FinishedAccountSignup $event): void
    {
    }
}
