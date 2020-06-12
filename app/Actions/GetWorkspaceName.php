<?php

declare(strict_types=1);

namespace App\Actions;

class GetWorkspaceName
{
    public static function execute(string $id): string
    {
        return  config('multi-database.workspace.prefix').str_replace('-', '_', $id);
    }
}
