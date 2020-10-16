<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\Lookup getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\Lookup create(array $request)
 * @method static \App\Domain\Models\Lookup refresh(\App\Domain\Models\Lookup $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\Lookup $model)
 * @method static \App\Domain\Repositories\Facades\LookupRepository with(array $data)
 * @method static \App\Domain\Repositories\Facades\LookupRepository purge()
 */
class LookupRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LookupRepository';
    }
}
