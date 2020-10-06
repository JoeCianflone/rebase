<?php

namespace App\Listeners;

use App\Events\StartCustomerSignup;

class CreateNewCustomer
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
    public function handle(StartCustomerSignup $event): void
    {
    }
}
