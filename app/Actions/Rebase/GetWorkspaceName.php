<?php

declare(strict_types=1);

namespace App\Actions\Rebase;

class GetWorkspaceName
{
    public static function handle(string $id): string
    {
        return  config('app-paths.db.workspace.prefix').str_replace('-', '_', $id);
    }
}
