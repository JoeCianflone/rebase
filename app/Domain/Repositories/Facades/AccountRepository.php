<?php
namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class AccountRepository extends Facade
{

    protected static function getFacadeAccessor(): string { return 'AccountRepository'; }
}
