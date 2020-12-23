<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\MigrationHelper;

class MakeRebaseMigration extends Command
{
    protected $signature = 'make:rebase-migration
                                {name : The name of your migration file, this should be explicit to what you are doing in this file}
                                {--shared : migration for the shared database}
                                {--rebase : use the rebase migration folder}';

    protected $description = 'Generates a migration file and puts it in the correct path';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $migrationHelper = new MigrationHelper();

        $this->call('make:migration', [
            'name' => $this->argument('name'),
            '--path' => $migrationHelper->path(rebase: $this->option('rebase'), shared: $this->option('shared')),
        ]);
    }
}
