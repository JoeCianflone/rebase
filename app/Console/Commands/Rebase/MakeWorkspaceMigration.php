<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;

class MakeWorkspaceMigration extends Command
{
    protected $signature = 'db:migration
                                {name : The name of your migration file, this should be explicit to what you are doing in this file}';

    protected $description = 'Generates a migration file and puts it in the correct path';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->call('make:migration', [
            'name' => $this->argument('name'),
            '--path' => config('rebase-paths.db.workspace.migration_path'),
        ]);
    }
}
