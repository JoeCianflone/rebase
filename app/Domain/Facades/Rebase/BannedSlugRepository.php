<?php

declare(strict_types=1);

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

class BannedSlugRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'BannedSlugRepository';
    }
}
