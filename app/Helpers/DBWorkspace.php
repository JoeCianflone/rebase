<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Actions\GetWorkspaceName;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DBWorkspace
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

    public static function allSpaces(string $prefix): Collection
    {
        return collect(DB::select("SHOW DATABASES LIKE '{$prefix}%'"))
            ->flatMap(fn ($item) => collect($item)->flatten())
            ->reject(fn ($item) => $item == config('multi-database.shared.name'))
            ->map(fn ($item) => str_replace($prefix, '', $item));
    }
}
