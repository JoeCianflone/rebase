<?php

namespace App\Listeners\Rebase;

use App\Events\Rebase\FinishedCustomerSignup;

class SendCustomerWelcomeEmail
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
