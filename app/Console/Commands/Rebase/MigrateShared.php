<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\MigrationHelper;

class MigrateShared extends Command
{
    protected $signature = 'migrate:shared';

    protected $description = 'Runs all the migrations for any shared databases';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $migrationHelper = (new MigrationHelper(['--no-interaction' => true]));

        $this->call('migrate', $migrationHelper->getOptions(shared: true, rebase: true));
        $this->call('migrate', $migrationHelper->getOptions(shared: true));
    }
}
