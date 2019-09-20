<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunRollback extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:rollback {workspace?} {--all} {--step=1} {--workspaces}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        if ($this->option('all')) {
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

        $this->info("Starting Rollback for: {$tenant->slug}");
        $this->callMigration('workspace', config('database.workspace_migrations'));
        $this->info("Starting Rollback for: {$tenant->slug}");
    }

    private function callMigration($conn, $path)
    {
        $this->call("migrate:rollback", [
            '--database' => $conn,
            '--path' => $path,
            '--step' => $this->option('step'),
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }
}
