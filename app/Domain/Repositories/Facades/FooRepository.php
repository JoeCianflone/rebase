<?php
namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class FooRepository extends Facade
{

    protected static function getFacadeAccessor(): string { return 'FooRepository'; }
}