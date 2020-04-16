<?php declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DBWorkspace
{
    public static function getName(string $id): string
    {
        return  config('multi-database.workspace.prefix') . str_replace("-", "_", $id);
    }

    public static function exists(string $id) : bool
    {
        $name = self::getName($id);

        $result = DB::select("SHOW DATABASES LIKE '{$name}'");
        return ! empty($result);
    }

    public static function create(string $id): bool
    {
        $name = self::getName($id);
        return DB::statement("CREATE DATABASE {$name};");
    }

    public static function drop(string $id): bool
    {
        $name = self::getName($id);
        return DB::statement("DROP DATABASE {$name};");
    }

    /**
     * @return Collection
     */
    public static function allSpaces(string $prefix): Collection
    {
        return collect(DB::select("SHOW DATABASES LIKE '{$prefix}%'"))
                ->flatMap(fn ($item) => collect($item)->flatten())
                ->reject(fn ($item) => $item == config('multi-database.shared.name'))
                ->map(fn ($item) => str_replace($prefix, '', $item));
    }

    /**
     * @return void
     */
    public static function connect(string $id): void
    {
        $name = self::getName($id);

        DB::disconnect('workspace');
        DB::purge('workspace');

        config()->set('database.connections.workspace.database', $name);
        config()->set('multi-database.workspace.name', $name);
        config()->set('queue.connections.redis.queue', $name);
        // config()->set('queue.failed.database', $name);
        // config()->set('multi-database.connections.workspace.host', $name());
        // config()->set('multi-database.connections.workspace.username', $name());
        // config()->set('multi-database.connections.workspace.password', $name());
    }
}
