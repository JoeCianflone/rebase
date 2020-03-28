<?php
namespace App\Domain\Repositories\Facades;

use Illuminate\Support\Facades\Facade;

class ListingRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ListingRepository';
    }
}
