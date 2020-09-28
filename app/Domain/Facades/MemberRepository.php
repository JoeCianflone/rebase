<?php

namespace App\Domain\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?\Illuminate\Support\Collection all()
 * @method static ?\App\Domain\Models\Member getByID(\Ramsey\Uuid\Uuid $id)
 * @method static \App\Domain\Models\Member create(array $request)
 * @method static \App\Domain\Models\Member refresh(\App\Domain\Models\Member $model)
 * @method static void update(int|\Ramsey\Uuid\Uuid $id)
 * @method static void remove(\App\Domain\Models\Member $model)
 * @method static \App\Domain\Facades\MemberRepository with(array $data)
 * @method static \App\Domain\Facades\MemberRepository purge()
 */
class MemberRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MemberRepository';
    }
}
