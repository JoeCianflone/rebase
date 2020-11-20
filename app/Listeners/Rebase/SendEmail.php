<?php

namespace App\Listeners\Rebase;

use App\Events\Rebase\Alert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmail
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
     * @param  Alert  $event
     * @return void
     */
    public function handle(Alert $event)
    {
        //
    }
}
