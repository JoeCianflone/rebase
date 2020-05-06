<?php

namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class UserRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'UserRepository';
    }
}
