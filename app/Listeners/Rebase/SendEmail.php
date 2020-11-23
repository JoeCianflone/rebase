<?php

namespace App\Listeners\Rebase;

use App\Events\Rebase\Alert;

class SendEmail
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
    public function handle(Alert $event): void
    {
    }
}
