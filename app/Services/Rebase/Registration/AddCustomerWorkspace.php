<?php

namespace App\Services\Rebase\Registration;

use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class AddCustomerWorkspace
{
    public function __invoke($payload)
    {
        $exitCode = Artisan::call("db:migrate {$payload->get('customer')->id}");

        if (0 === $exitCode) {
            $workspace = WorkspaceRepository::create([
                'customer_id' => $payload->get('customer')->id,
                'name' => $payload->get('customer')->name.' Workspace',
                'slug' => $payload->get('slug'),
            ]);

            $payload->put('workspace', $workspace);

            return $payload;
        }

        return false;
    }
}
