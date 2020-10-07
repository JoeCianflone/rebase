<?php

namespace App\Services\Registration;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class AddCustomerWorkspace
{
    public function __invoke($payload)
    {
        $workspaceName = $payload->get('customer')->is_business ? $payload->get('customer')->business_name : $payload->get('customer')->name;
        $workspaceName = Str::plural($workspaceName);

        $payload->get('customer')->workspaces()->create([
            'name' => "{$workspaceName} Workspace",
            'slug' => $payload->get('slug'),
        ]);

        $exitCode = Artisan::call("db:migrate {$payload->get('customer')->id} --seed");

        if (0 !== $exitCode) {
            // event(Spinning Up Database Failed)
            return false;
        }

        return $payload;
    }
}
