<?php
namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TenantDB
{

    public static function getName(string $id): string
    {
        return config('tenant.workspace_prefix') . str_replace("-", "_", $id);
    }

    public static function exists(string $id) : bool
    {
        $name = self::getName($id);

        $result = DB::select("SHOW DATABASES LIKE '{$name}'");
        return ! empty($result);
    }

    public static function create($id): bool
    {
        $name = self::getName($id);
        return DB::statement("CREATE DATABASE {$name};");
    }

    public static function drop(): bool
    {
        $name = self::getName($id);
        return DB::statement("DROP DATABASE {$name};");
    }

    /**
     * @return Collection
     */
    public static function allTenants(): Collection
    {
        $prefix = config('tenant.workspace_prefix');

        $workspaces = collect(DB::select("SHOW DATABASES LIKE '{$prefix}%'"));

        return $workspaces->flatMap(function($item) {
            return collect($item)->flatten();
        })->map(function($item) use ($prefix) {
            return str_replace($prefix, '', $item);
        });
    }

    /**
     * @return void
     */
    public function connect($id): void
    {
        $name = self::getName($id);

        DB::disconnect('workspace');
        DB::purge('workspace');

        config()->set('tenant.connections.workspace.database', $name);
        // config()->set('tenant.connections.workspace.host', $name());
        // config()->set('tenant.connections.workspace.username', $name());
        // config()->set('tenant.connections.workspace.password', $name());
    }

}
