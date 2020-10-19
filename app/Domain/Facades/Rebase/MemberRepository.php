<?php

namespace App\Domain\Facades\Rebase;

use Illuminate\Support\Facades\Facade;

class MemberRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MemberRepository';
    }
}
