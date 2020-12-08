<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Rebase\ExtraWorkspaces;
use Database\Seeders\Rebase\BannedSlugSeeder;
use Database\Seeders\Rebase\PersonalWorkspace;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BannedSlugSeeder::class);
        $this->call(PersonalWorkspace::class);
    }
}
