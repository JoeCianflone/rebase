<?php

declare(strict_types=1);

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\UserWorkspace getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\UserWorkspace create(array $request)
 * @method static \App\Domain\Models\UserWorkspace refresh(\App\Domain\Models\UserWorkspace $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\UserWorkspace $model)
 * @method static \App\Domain\Facades\UserWorkspaceRepository with(array $data)
 * @method static \App\Domain\Facades\UserWorkspaceRepository purge()
 */
class UserWorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'UserWorkspaceRepository';
    }
}
