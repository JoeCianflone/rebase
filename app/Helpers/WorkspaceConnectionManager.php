<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Actions\GetWorkspaceName;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\Events\JobProcessing;

class WorkspaceConnectionManager
{
    public static function connect(string $id): void
    {
        $name = GetWorkspaceName::execute($id);

        self::config($name);

        app('queue')->createPayloadUsing(fn () => ['workspace_id ' => $name]);
        app('events')->listen(JobProcessing::class, function ($event): void {
            if (isset($event->job->payload()['workspace_id'])) {
                self::config($event->job->payload()['workspace_id']);
            }
        });
    }

    public static function disconnect(): void
    {
        DB::disconnect('workspace');
        DB::purge('workspace');
    }

    private static function config(string $name): void
    {
        config([
            'database.connections.workspace.database' => $name,
            'database.redis.default.database' => $name,
            'database.redis.cache.database' => $name.'_cache',
            'multi-database.workspace.name' => $name,
            'session.files' => storage_path('framework/sessions/'.$name),
            'cache.prefix' => $name,
            'filesystem.disks.local.root' => storage_path('app/'.$name),
            'queue.connections.redis.queue' => $name,
        ]);

        app('cache')->forgetDriver(config('cache.default'));
    }
}
