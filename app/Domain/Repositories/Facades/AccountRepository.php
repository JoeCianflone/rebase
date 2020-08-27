<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\Account getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\Account create(array $request)
 * @method static \App\Domain\Models\Account refresh(\App\Domain\Models\Account $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\Account $model)
 * @method static \App\Domain\Repositories\Facades\AccountRepository with(array $data)
 * @method static \App\Domain\Repositories\Facades\AccountRepository purge()
 */
class AccountRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'AccountRepository';
    }
}
