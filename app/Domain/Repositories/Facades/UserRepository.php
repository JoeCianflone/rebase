<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\User getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\User create(array $request)
 * @method static \App\Domain\Models\User refresh(\App\Domain\Models\User $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\User $model)
 * @method static \App\Domain\Repositories\Facades\UserRepository with(array $data)
 * @method static \App\Domain\Repositories\Facades\UserRepository purge()
 */
class UserRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'UserRepository';
    }
}
