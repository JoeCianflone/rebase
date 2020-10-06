<?php

namespace App\Listeners;

use App\Events\StartCustomerSignup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateNewCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StartCustomerSignup  $event
     * @return void
     */
    public function handle(StartCustomerSignup $event)
    {
        //
    }
}
