<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models create(array $request)
 * @method static \App\Domain\Models refresh(\App\Domain\Models $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models $model)
 * @method static \App\Domain\Facades\WorkspaceRepository with(array $data)
 * @method static \App\Domain\Facades\WorkspaceRepository purge()
 */ class WorkspaceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'WorkspaceRepository';
    }
}
