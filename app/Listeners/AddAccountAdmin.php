<?php

namespace App\Listeners;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use App\Events\AccountReady;
use App\Events\WorkspaceCreated;
use Illuminate\Support\Facades\Hash;
use App\Domain\Facades\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain\Facades\MemberWorkspaceRepository;

class AddAccountAdmin implements ShouldQueue
{
    public string $queue = 'general';

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
            'first_time_login_token' => Hash::make($event->setupData['email']),
        ]);

        $MemberWorkspace = MemberWorkspaceRepository::create([
            'id' => Str::uuid(),
            'account_id' => $event->workspace['account_id'],
            'user_id' => $admin->id,
            'workspace_id' => $event->workspace['id'],
            'role' => UserRole::ACCOUNT_OWNER(),
        ]);

        event(new AccountReady($admin, $MemberWorkspace));
    }
}
