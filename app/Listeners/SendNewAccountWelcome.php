<?php

namespace App\Listeners;

use App\Mail\WelcomeAccount;
use App\Events\NewAccountCreated;
use Illuminate\Support\Facades\Mail;

class SendNewAccountWelcome
{
    public function __construct()
    {
    }

    public function handle(NewAccountCreated $event): void
    {
        // Mail::to($event->user['email'])
        //     ->queue((new WelcomeAccount($event->workspace, $event->user))->onQueue('system-email'))
        // ;
    }
}
