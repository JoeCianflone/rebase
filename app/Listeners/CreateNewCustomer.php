<?php

namespace App\Listeners;

use App\Mail\NewCustomer;
use League\Pipeline\Pipeline;
use App\Events\StartCustomerSignup;
use App\Events\FailedCustomerSignup;
use Illuminate\Support\Facades\Mail;
use App\Events\FinishedCustomerSignup;
use App\Services\Registration\AddCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Registration\SubscribeCustomer;
use App\Exceptions\CustomerRegistrationException;
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
        // return collect($event->payload);
        try {
            $pipeline = (new Pipeline())
                ->pipe(new AddCustomer())
                ->pipe(new SubscribeCustomer())
                ->pipe(new AddCustomerWorkspace())
                ->pipe(new AddFirstMemberToWorkspace());

            $pipeline->process(collect($event->payload));
        } catch (CustomerRegistrationException $e) {
            //     event(new FailedCustomerSignup(['mesaage' => $e->message, 'request_data' => $event->payload]));
        }

        // Mail::to($event->payload['email'])
        //     ->send(new NewCustomer());
        // event(new FinishedCustomerSignup($event->payload));
    }
}
