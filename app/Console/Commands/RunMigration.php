<?php

namespace App\Console\Commands;

use App\Helpers\DBHelper;
use Illuminate\Console\Command;
use App\Domain\Repositories\Facades\TenantRepository;

class RunMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:migrate {workspace?} {--all} {--workspaces} {--no-shared}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all the migrations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->option('no-shared')) {
            $this->callMigration('shared', config('database.shared_migrations'));
        }

        if ($this->option('workspaces') || $this->option('all')) {
            $tenants = TenantRepository::getAll();

            $tenants->each(function($tenant) {
                $this->migrateTenant($tenant);
            });
        }

        if ($this->argument('workspace')) {
            $tenant = TenantRepository::getBySlug($this->argument('workspace'));

            $this->migrateTenant($tenant);
        }

    }

    private function migrateTenant($tenant)
    {
        $connection = new DBHelper($tenant->account_id);

        if (!$connection->exists()) {
            $this->info("Connection does not exist...creating");
            $connection->create();
        }

        $connection->connect();

        $this->info("Starting Migration for: {$tenant->slug}");
        $this->callMigration('workspace', config('database.workspace_migrations'));
        $this->info("Starting Migration for: {$tenant->slug}");
    }

    private function callMigration($conn, $path)
    {
        $this->call("migrate", [
            '--database' => $conn,
            '--path' => $path,
            '--step' => true,
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }
}
