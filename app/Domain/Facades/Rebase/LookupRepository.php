<?php declare(strict_types=1);

namespace App\Domain\Facades\Rebase;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static query(?Model $model = null)
 * @method static factory(?Model $model = null)
 * @method static filter(?Model $model = null)
 */
class LookupRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LookupRepository';
    }
}
