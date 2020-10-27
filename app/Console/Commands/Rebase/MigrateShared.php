<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\MigrationHelper;

class MigrateShared extends Command
{
    protected $signature = 'migrate:shared {--rebase}';

    protected $description = 'Runs all the migrations for one the shared database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $migrationHelper = (new MigrationHelper($this->option('rebase')))
            ->addOptions(['--no-interaction' => true])
            ->configurePath(false);

        $this->call('migrate', $migrationHelper->getOptions());
    }
}
