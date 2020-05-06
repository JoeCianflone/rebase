<?php

namespace App\Console\Commands;

use App\Domain\Models\Listing;
use App\Domain\Repositories\Facades\ListingRepository;
use App\Helpers\DBWorkspace;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class RunMigration extends Command
{
    protected $signature = 'db:migrate {workspace?} {--all} {--workspaces} {--no-shared}';

    protected $description = 'Runs all the migrations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if (!$this->option('no-shared')) {
            $this->callMigration('shared', config('multi-database.shared.migration_path'));
        }

        if ($this->option('workspaces') || $this->option('all')) {
            $tenants = ListingRepository::getAll();

            $tenants->each(function ($tenant) {
                $this->migrateTenant($tenant);
            });
        }

        if ($this->argument('workspace')) {
            $tenant = ListingRepository::getBySlug($this->argument('workspace'));

            $this->migrateTenant($tenant);
        }
    }

    /**
     * @param Listing|Model $tenant
     */
    private function migrateTenant($tenant): void
    {
        if (!DBWorkspace::exists($tenant->account_id)) {
            $this->info('Connection does not exist...creating');
            DBWorkspace::create($tenant->account_id);
        }

        DBWorkspace::connect($tenant->account_id);

        $this->info("Starting Migration for: {$tenant->slug}");
        $this->callMigration('workspace', config('multi-database.workspace.migration_path'));
    }

    private function callMigration(string $conn, string $path): void
    {
        $this->call('migrate', [
            '--database' => $conn,
            '--path' => $path,
            '--step' => true,
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }
}
