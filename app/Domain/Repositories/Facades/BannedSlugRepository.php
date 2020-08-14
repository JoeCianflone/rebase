<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class BannedSlugRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'BannedSlugRepository';
    }
}
