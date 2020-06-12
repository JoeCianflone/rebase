<?php

namespace App\Console\Commands;

use App\Helpers\DBWorkspace;
use Illuminate\Console\Command;
use App\Domain\Repositories\Facades\WorkspaceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DBExplode extends Command
{
    protected $signature = 'db:explode
                                {workspace_name? : optional name of the workspace you\' like to blow up}
                                {--reset : just delete do not rerun the migrations}';

    protected $description = 'Blow out local shared and/or local workspace databases';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        if ('local' !== app()->environment()) {
            $this->error('This command only runs in local environments');
            exit(1);
        }

        if ($this->argument('workspace_name')) {
            $this->dropWorkspace($this->argument('workspace_name'));
            exit();
        }

        if ($this->confirm('You are about to delete all your databases, you sure you know what you\'re doing??')) {
            $this->info('Hold on to your butts');

            $this->dropAllWorkspaces();

            $this->dropShared();

            $this->line('');
            $this->info('Data go :boom:');
        } else {
            $this->error('OH GOD WE DELETED EVERYTHING! ');
            $this->info('Kidding, you aborted your data is safe :)');
        }
    }

    private function dropShared(): void
    {
        $this->alert('Refreshing Shared Database');

        if ($this->option('reset')) {
            $this->call('migrate:reset', [
                '--database' => config('multi-database.shared.connection'),
                '--path' => config('multi-database.shared.migration_path'),
            ]);
        } else {
            $this->call('migrate:fresh', [
                '--database' => config('multi-database.shared.connection'),
                '--path' => config('multi-database.shared.migration_path'),
                '--step' => true,
            ]);
        }
    }

    private function dropAllWorkspaces(): void
    {
        $allSpaces = DBWorkspace::allSpaces(config('multi-database.workspace.prefix'));

        if ($allSpaces->count() > 0) {
            $this->line('');
            DBWorkspace::allSpaces(config('multi-database.workspace.prefix'))->each(function ($id): void {
                DBWorkspace::drop($id);

                $this->line('<comment>Dropped: '.config('multi-database.workspace.prefix')."{$id}</comment>");
            });
        }
    }

    /**
     * @param mixed $workspaceName
     */
    private function dropWorkspace($workspaceName): void
    {
        try {
            $workspace = WorkspaceRepository::getBySlug($workspaceName);
            $this->alert("Dropping workspace {$workspaceName}");
            DBWorkspace::drop($workspace->id);

            $this->line('');
            $this->info($this->argument('workspace_name').' has gone :boom:');
        } catch (ModelNotFoundException $e) {
            $this->error("Unable to find workspace {$workspaceName}");
        }
    }
}
