<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Actions\GetWorkspaceName;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\Events\JobProcessing;

class WorkspaceDatabase
{
    public static function exists(string $id): bool
    {
        $name = GetWorkspaceName::execute($id);

        $result = DB::select("SHOW DATABASES LIKE '{$name}'");

        return !empty($result);
    }

    public static function create(string $id): bool
    {
        $name = GetWorkspaceName::execute($id);

        return DB::statement("CREATE DATABASE {$name};");
    }

    public static function drop(string $id): bool
    {
        $name = GetWorkspaceName::execute($id);

        return DB::statement("DROP DATABASE {$name};");
    }

    public static function allSpaces(string $prefix): ?Collection
    {
        return collect(DB::select("SHOW DATABASES LIKE '{$prefix}%'"))
            ->flatMap(fn ($item) => collect($item)->flatten())
            ->reject(fn ($item) => $item == config('app-paths.db.shared.name'))
            ->map(fn ($item) => str_replace($prefix, '', $item));
    }

    public static function connect(string $id): void
    {
        $name = GetWorkspaceName::execute($id);

        self::connectionConfigure($name);

        app('queue')->createPayloadUsing(fn () => ['workspace_id ' => $name]);
        app('events')->listen(JobProcessing::class, function ($event): void {
            if (isset($event->job->payload()['workspace_id'])) {
                self::connectionConfigure($event->job->payload()['workspace_id']);
            }
        });
    }

    public static function disconnect(): void
    {
        DB::disconnect('workspace');
        DB::purge('workspace');
    }

    public static function connectionConfigure(string $name): void
    {
        config([
            'database.connections.workspace.database' => $name,
            'database.redis.default.database' => $name,
            'database.redis.cache.database' => $name.'_cache',
            'app-paths.db.workspace.name' => $name,
            'session.files' => storage_path('framework/sessions/'.$name),
            'cache.prefix' => $name,
            'filesystem.disks.local.root' => storage_path('app/'.$name),
        ]);

        app('cache')->forgetDriver(config('cache.default'));
    }    
}
