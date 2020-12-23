<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\MigrationHelper;
use App\Helpers\Rebase\DatabaseHelper;
use App\Domain\Facades\Rebase\CustomerRepository;

class MigrateWorkspaces extends Command
{
    protected $signature = 'migrate:workspaces {customerID?}';

    protected $description = 'Runs all the migrations for one or more workspaces';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if (!$this->argument('customerID')) {
            $this->migrateAllWorkspaces();
        }

        if ($this->argument('customerID')) {
            $this->migrateWorkspace($this->argument('customerID'));
        }
    }

    private function migrateWorkspace(string $customerID): void
    {
        if (!DatabaseHelper::exists($customerID)) {
            DatabaseHelper::create($customerID);
        }

        DatabaseHelper::disconnect();
        DatabaseHelper::connect($customerID);

        $migrationHelper = (new MigrationHelper([
            '--no-interaction' => true,
            '--database' => config('paths.db.workspace.connection'),
        ]));

        $this->call('migrate', $migrationHelper->getOptions(rebase: true));
        $this->call('migrate', $migrationHelper->getOptions());
    }

    private function migrateAllWorkspaces(): void
    {
        Customer::get()->each(function ($customer): void {
            $this->migrateWorkspace($customer->id);
        });
    }
}
