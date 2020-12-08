<?php

namespace App\Domain\Facades\Rebase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**

 * @method static query(?Model $model = null)
 * @method static factory(?Model $model = null)
 * @method static filter(?Model $model = null)
 */
class MemberRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MemberRepository';
    }
}
