<?php

namespace App\Listeners\Rebase;

use App\Events\Rebase\FailedCustomerSignup;

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
    public function handle(FailedCustomerSignup $event)
    {
        return false;
    }
}
