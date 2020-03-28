<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeMigration extends Command
{
    protected $signature = 'db:migration
                                {name : The name of your migration file, this should be explicit to what you are doing in this file}
                                {--shared : If the migtation is for a shared databse and not the workspaces, use this option and the file gets created in the right place}';

    protected $description = 'Generates a migration file and puts it in the correct path';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $path = $this->option('shared') ? config('multi-database.shared.migration_path') : config('multi-database.workspace.migration_path');

        $this->call("make:migration", [
            'name' => $this->argument('name'),
            '--path' => $path
        ]);

        exit();
    }
}
