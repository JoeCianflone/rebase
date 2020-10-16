<?php

namespace App\Listeners;

use App\Events\FinishedCustomerSignup;

class SendSuperAdminEmail
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
    public function handle(FinishedCustomerSignup $event): void
    {
    }
}
