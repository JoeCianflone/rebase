<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class BanlistRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'BanlistRepository';
    }
}
