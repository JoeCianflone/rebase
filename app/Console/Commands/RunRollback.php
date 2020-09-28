<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\WorkspaceDatabase;
use App\Domain\Facades\WorkspaceRepository;
use App\Helpers\WorkspaceConnectionManager;

class RunRollback extends Command
{
    protected $signature = 'db:rollback
                                  {workspace?}
                                  {--all}
                                  {--step=1}
                                  {--workspaces}';

    protected $description = 'Roll back migrations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if ($this->option('all')) {
            $this->callMigration('shared', config('app-paths.db.shared.migration_path'));
        }

        if ($this->option('workspaces') || $this->option('all')) {
            $workspaces = WorkspaceRepository::all();

            $workspaces->each(function ($workspace): void {
                $this->migrateWorkspace($workspace);
            });
        }

        if ($this->argument('workspace')) {
            $workspace = WorkspaceRepository::getBySlug($this->argument('workspace'));

            $this->migrateWorkspace($workspace);
        }
    }

    private function migrateWorkspace(Workspace $workspace): void
    {
        if (!WorkspaceDatabase::exists($workspace->id)) {
            $this->info('Connection does not exist...creating');
            WorkspaceDatabase::create($workspace->id);
        }

        WorkspaceConnectionManager::disconnect();
        WorkspaceConnectionManager::connect($workspace->id);

        $this->info("Starting Rollback for: {$workspace->slug}");
        $this->callMigration('workspace', config('app-paths.db.workspace.migration_path'));
    }

    private function callMigration(string $conn, string $path): void
    {
        $this->call('migrate:rollback', [
            '--database' => $conn,
            '--path' => $path,
            '--step' => $this->option('step'),
            '--force' => true,
            '--no-interaction' => true,
        ]);
    }
}
