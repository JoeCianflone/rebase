<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\Models\Workspace;
use App\Helpers\WorkspaceDatabase;
use App\Domain\Facades\CustomerRepository;
use App\Helpers\WorkspaceConnectionManager;

class RunMigration extends Command
{
    /**
     * php artisan db:migrate
     * php artisan db:migrate --shared
     * php artisan db:migrate --workspaces
     * php artisan db:migrate 12345.
     */
    protected $signature = 'db:migrate {customerID?} {--workspaces} {--shared}';

    protected $description = 'Runs all the migrations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if (!$this->option('shared') && !$this->option('workspaces') && !$this->argument('customerID')) {
            $this->migrateShared();
            $this->migrateAllWorkspaces();
        }

        if ($this->option('shared')) {
            $this->migrateShared();
        }

        if ($this->option('workspaces')) {
            $this->migrateAllWorkspaces();
        }

        if ($this->argument('customerID')) {
            $this->migrateWorkspace($this->argument('customerID'));
        }
    }


    private function migrateShared(): void
    {
        $this->callMigration();
    }

    private function migrateWorkspace($customerID): void
    {
         if (! WorkspaceDatabase::exists($customerID)) {
            WorkspaceDatabase::create($customerID);
         }

         WorkspaceDatabase::disconnect();
         WorkspaceDatabase::connect($customerID);

         $this->callMigration(config('app-paths.db.workspace.migration_path'));
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
            $options['--database'] = config('app-paths.db.workspace.connection');
            $options['--path'] = $path;
        }

        $this->call('migrate', $options);
    }
}
