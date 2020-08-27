<?php

namespace App\Listeners;

use App\Events\WorkspaceCreated;

class SendSuperAdminNewWorkspaceEmail
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
    public function handle(WorkspaceCreated $event): void
    {
    }
}
