<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use App\Events\WorkspaceCreated;
use App\Events\NewAccountCreated;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\WorkspaceRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateWorkspace implements ShouldQueue
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
    public function handle(NewAccountCreated $event): void
    {
        $workspace = WorkspaceRepository::create([
            'id' => (string) Str::uuid(),
            'account_id' => $event->account['id'],
            'name' => $event->account['name'],
            'slug' => $event->setupData['slug'],
            'is_active' => true,
        ]);

        $exitCode = Artisan::call("db:migrate {$workspace->slug} --no-shared");

        // if (0 === $exitCode) {
        //     event(new WorkspaceCreated($workspace, [
        //         'name' => $event->setupData['name'],
        //         'email' => $event->setupData['email'],
        //     ]));
        // }
    }
}
