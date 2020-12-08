<?php

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

/**
 * @method static query()
 * @method static factory()
 * @method static filter()
 */
class WorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WorkspaceRepository';
    }
}
