<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class WorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WorkspaceRepository';
    }
}
