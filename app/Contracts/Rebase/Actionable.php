<?php

namespace App\Contracts\Rebase;

interface Actionable
{
    public static function handle(...$payload);
}
