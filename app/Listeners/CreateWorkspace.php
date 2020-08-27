<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use App\Events\WorkspaceCreated;
use App\Events\NewAccountCreated;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Repositories\Facades\WorkspaceRepository;

class CreateWorkspace
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
    public function handle(NewAccountCreated $event): void
    {
        $workspace = WorkspaceRepository::create([
            'id' => Str::uuid(),
            'account_id' => $event->account['id'],
            'name' => $event->account['name'],
            'slug' => $event->setupData['workspace'],
            'is_active' => true,
        ]);

        $exitCode = Artisan::call("db:migrate {$workspace->slug} --no-shared");

        if (0 === $exitCode) {
            event(new WorkspaceCreated($workspace, [
                'name' => $event->setupData['name'],
                'email' => $event->setupData['email'],
            ]));
        }
    }
}
