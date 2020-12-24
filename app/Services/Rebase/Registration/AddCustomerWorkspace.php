<?php

namespace App\Services\Rebase\Registration;

use App\Domain\Models\Rebase\Workspace\Workspace;
use Illuminate\Support\Facades\Artisan;

class AddCustomerWorkspace
{
    public function __invoke($payload)
    {
        $exitCode = Artisan::call('migrate:workspaces', [
            'customerID' => $payload->get('customer')->id
        ]);

        if (0 === $exitCode) {
            $workspace = Workspace::modelFactory()->create([
                'customer_id' => $payload->get('customer')->id,
                'name' => $payload->get('customer')->name.' Workspace',
                'sub' => $payload->get('sub'),
            ]);

            $payload->put('workspace', $workspace);

            return $payload;
        }

        return false;
    }
}
