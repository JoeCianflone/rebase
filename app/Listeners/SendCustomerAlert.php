<?php

namespace App\Listeners;

use App\Events\FailedCustomerSignup;

class SendCustomerAlert
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
    public function handle(FailedCustomerSignup $event): void
    {
    }
}
