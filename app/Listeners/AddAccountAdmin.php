<?php

namespace App\Listeners;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use App\Events\WorkspaceCreated;
use App\Domain\Repositories\Facades\UserRepository;
use App\Domain\Repositories\Facades\UserWorkspaceRepository;

class AddAccountAdmin
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
        $admin = UserRepository::create([
            'id' => Str::uuid(),
            'name' => $event->setupData['name'],
            'email' => $event->setupData['email'],
        ]);

        UserWorkspaceRepository::create([
            'id' => Str::uuid(),
            'account_id' => $event->workspace['account_id'],
            'user_id' => $admin->id,
            'workspace_id' => $event->workspace['id'],
            'role' => UserRole::ACCOUNT_OWNER(),
        ]);
    }
}
