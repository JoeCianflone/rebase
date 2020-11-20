<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\MigrationHelper;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\CustomerRepository;

class MigrateWorkspaces extends Command
{
    protected $signature = 'migrate:workspaces {customerID?} {--rebase}';

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

    private function migrateWorkspace($customerID): void
    {
        if (!WorkspaceDatabase::exists($customerID)) {
            WorkspaceDatabase::create($customerID);
        }

        WorkspaceDatabase::disconnect();
        WorkspaceDatabase::connect($customerID);

        $migrationHelper = (new MigrationHelper($this->option('rebase')))->addOptions([
            '--no-interaction' => true,
            '--database' => config('rebase-paths.db.workspace.connection'),
        ])->configurePath(true);

        $this->call('migrate', $migrationHelper->getOptions());
    }

    private function migrateAllWorkspaces(): void
    {
        CustomerRepository::query()->getAll()->each(function ($customer): void {
            $this->migrateWorkspace($customer->id);
        });
    }
}
