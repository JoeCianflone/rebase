<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Rebase\ExtraWorkspaces;
use Database\Seeders\Rebase\PersonalWorkspace;
use Database\Seeders\Rebase\BannedSubdomainSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BannedSubdomainSeeder::class);
        $this->call(PersonalWorkspace::class);
    }
}
