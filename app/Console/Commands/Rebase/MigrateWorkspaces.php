<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\WorkspaceDatabase;
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

    private function migrateWorkspace($customerID): void
    {
        if (!WorkspaceDatabase::exists($customerID)) {
            WorkspaceDatabase::create($customerID);
        }

        WorkspaceDatabase::disconnect();
        WorkspaceDatabase::connect($customerID);

        $this->callMigration(config('rebase-paths.db.workspace.migration_path'));
    }

    private function migrateAllWorkspaces(): void
    {
        CustomerRepository::all()->each(function ($customer): void {
            $this->migrateWorkspace($customer->id);
        });
    }

    private function callMigration(?string $path = null): void
    {
        $options = [
            '--step' => true,
            '--force' => true,
            '--no-interaction' => true,
        ];

        if (!is_null($path)) {
            $options['--database'] = config('rebase-paths.db.workspace.connection');
            $options['--path'] = $path;
        }

        $this->call('migrate', $options);
    }
}
