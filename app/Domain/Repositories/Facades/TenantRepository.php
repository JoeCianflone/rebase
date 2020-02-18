<?php
namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class TenantRepository extends Facade
{

    protected static function getFacadeAccessor(): string { return 'TenantRepository'; }
}
