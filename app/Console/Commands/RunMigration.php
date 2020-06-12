<?php

namespace App\Console\Commands;

use App\Helpers\DBWorkspace;
use Illuminate\Console\Command;
use App\Domain\Models\Workspace;
use App\Helpers\WorkspaceConnectionManager;
use App\Domain\Repositories\Facades\WorkspaceRepository;

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
            $workspaces = WorkspaceRepository::all();

            $workspaces->each(function ($workspace): void {
                $this->migrateTenant($workspace);
            });
        }

        if ($this->argument('workspace')) {
            $workspace = WorkspaceRepository::getBySlug($this->argument('workspace'));

            $this->migrateTenant($workspace);
        }
    }

    private function migrateTenant(Workspace $workspace): void
    {
        if (!DBWorkspace::exists($workspace->id)) {
            $this->info('Connection does not exist...creating');
            DBWorkspace::create($workspace->id);
        }

        WorkspaceConnectionManager::disconnect();
        WorkspaceConnectionManager::connect($workspace->id);

        $this->info("Starting Migration for: {$workspace->slug}");
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
