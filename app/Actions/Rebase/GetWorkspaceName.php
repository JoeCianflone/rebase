<?php declare(strict_types=1);

namespace App\Actions\Rebase;

use App\Contracts\Rebase\Actionable;

class GetWorkspaceName implements Actionable
{
    public static function handle(...$payload): string
    {
        [$id] = $payload;

        return  config('paths.db.workspace.prefix').str_replace('-', '_', $id);
    }
}
