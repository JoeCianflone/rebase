<?php

declare(strict_types=1);

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

class LookupRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LookupRepository';
    }
}
