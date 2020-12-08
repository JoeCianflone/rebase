<?php declare(strict_types=1);

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

/**
 * @method static query()
 * @method static factory()
 * @method static filter()
 */
class RoleRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'RoleRepository';
    }
}
