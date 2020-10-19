<?php

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

class WorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WorkspaceRepository';
    }
}
