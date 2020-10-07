<?php

namespace App\Listeners;

use League\Pipeline\Pipeline;
use App\Events\StartCustomerSignup;
use App\Services\Registration\AddCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Registration\SubscribeCustomer;
use App\Services\Registration\AddCustomerWorkspace;
use App\Services\Registration\AddFirstMemberToWorkspace;

class CreateNewCustomer implements ShouldQueue
{
    public $queue = 'general';

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
        $pipeline = (new Pipeline())
            ->pipe(new AddCustomer())
            ->pipe(new SubscribeCustomer())
            ->pipe(new AddCustomerWorkspace())
            ->pipe(new AddFirstMemberToWorkspace());

        $pipeline->process(collect($event->payload));
    }
}
