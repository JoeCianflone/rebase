<?php

declare(strict_types=1);

namespace App\Actions;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\Events\JobProcessing;
use App\Domain\Repositories\Facades\WorkspaceRepository;

class WorkspaceConfig
{
    public static function execute(Uuid $id): void
    {
        $name = config('multi-database.workspace.prefix').str_replace('-', '_', $id->toString());

        DB::purge('workspace');

        config([
            'database.connections.workspace.database' => $name,
            'session.files' => storage_path('framework/sessions/'.$name),
            'cache.prefix' => $name,
        ]);

        app('cache')->forgetDriver(config('cache.default'));
        config()->set('multi-database.workspace.name', $name);
        config()->set('queue.connections.redis.queue', $name);
        // config()->set('queue.failed.database', $name);
        // config()->set('multi-database.connections.workspace.host', $name());
        // config()->set('multi-database.connections.workspace.username', $name());
        // config()->set('multi-database.connections.workspace.password', $name());
    }

    private static function configQueue(): void
    {
        app('queue')->createPayloadUsing(fn () => []);
        app('events')->listen(JobProcessing::class, function ($event): void {
            if (isset($event->job->payload()['workspace_id'])) {
                WorkspaceRepository::getByAccountId($event->job->payload());
            }
        });
    }
}
