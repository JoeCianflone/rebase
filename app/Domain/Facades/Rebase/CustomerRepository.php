<?php

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

class CustomerRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'CustomerRepository';
    }
}
