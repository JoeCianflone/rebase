<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BannedSlugSeeder::class);
        $this->call(PersonalWorkspace::class);
        $this->call(ExtraWorkspaces::class);
    }
}
