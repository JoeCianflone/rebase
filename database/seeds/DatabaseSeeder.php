<?php

use App\Domain\Models\Tenant;
use App\Domain\Models\Account;
use Illuminate\Database\Seeder;
use App\Domain\Models\Workspace;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = factory(Account::class, 1)->create();
        $tenant = factory(Tenant::class)->create([
            'account_id' => $account->id,
        ]);
        $workspace = factory(Workspace::class)->create([

        ]);
        // Generate a workspace
        // Add account/workspace to the Tenant table
        // Create a User for the Workspace
        // Create an Admin User for the Workspace
    }
}
