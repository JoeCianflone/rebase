<?php

namespace App\Services\Registration;

use Closure;
use App\Contracts\Pipe;

class CreateNewWorkspace implements Pipe
{
    public function handle($payload, Closure $next)
    {
        return $next($payload);
    }
}
