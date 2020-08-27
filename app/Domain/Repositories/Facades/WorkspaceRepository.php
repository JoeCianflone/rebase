<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\Workspace getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\Workspace create(array $request)
 * @method static \App\Domain\Models\Workspace refresh(\App\Domain\Models\Workspace $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\Workspace $model)
 * @method static \App\Domain\Repositories\Facades\WorkspaceRepository with(array $data)
 * @method static \App\Domain\Repositories\Facades\WorkspaceRepository purge()
 */ class WorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WorkspaceRepository';
    }
}
