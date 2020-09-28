<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\Customer getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\Customer create(array $request)
 * @method static \App\Domain\Models\Customer refresh(\App\Domain\Models\Customer $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\Customer $model)
 * @method static \App\Domain\Facades\CustomerRepository with(array $data)
 * @method static \App\Domain\Facades\CustomerRepository purge()
 */
class CustomerRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'CustomerRepository';
    }
}
