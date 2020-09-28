<?php

namespace App\Services\Registration;

use Closure;
use App\Contracts\Pipe;
use Illuminate\Support\Facades\Artisan;

class CreateNewDatabase implements Pipe
{
    public function handle($payload, Closure $next)
    {
        $exitCode = Artisan::call("db:migrate {$payload->account->id} --no-shared");

        if (0 !== $exitCode) {
            // event(Spinning Up Database Failed)
            return false;
        }

        return $next($payload);
    }
}
