<?php

namespace App\Services\Registration;

use Illuminate\Support\Facades\Artisan;

class CreateNewDatabase
{
    public function __invoke($payload)
    {
        $exitCode = Artisan::call("db:migrate {$payload->account->id} --no-shared");

        if (0 !== $exitCode) {
            // event(Spinning Up Database Failed)
            return false;
        }

        return $payload;
    }
}
