<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\WorkspaceDatabase;
use App\Domain\Facades\Rebase\WorkspaceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DBExplode extends Command
{
    protected $signature = 'db:explode
                                {slug? : optional name of the workspace you\' like to blow up}
                                {--reset : just delete do not rerun the migrations}
                                {--seed : seed the DB after we clean it out}';

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

        if ($this->argument('slug')) {
            $this->dropWorkspace($this->argument('slug'));
            exit();
        }

        if ($this->confirm('You are about to delete all your databases, you sure you know what you\'re doing??')) {
            $this->info('Hold on to your butts');

            $this->dropAllWorkspaces();
            $this->dropShared();

            $this->newLine();
            $this->info('Data go :boom:');
        } else {
            $this->error('OH GOD WE DELETED EVERYTHING! ');
            $this->info('Kidding, you aborted, your data is safe :)');
        }
    }

    private function dropShared(): void
    {
        $this->alert('Refreshing Shared Database');

        if ($this->option('reset')) {
            $this->call('migrate:reset');
        } else {
            $this->call('migrate:fresh', [
                '--step' => true,
                '--seed' => $this->option('seed'),
            ]);
        }
    }

    private function dropAllWorkspaces(): void
    {
        $allSpaces = WorkspaceDatabase::allSpaces(config('app-paths.db.workspace.prefix'));

        if (!is_null($allSpaces) && $allSpaces->count() > 0) {
            $this->newLine();
            WorkspaceDatabase::allSpaces(config('app-paths.db.workspace.prefix'))->each(function ($id): void {
                WorkspaceDatabase::drop($id);

                $this->line('<comment>Dropped: '.config('app-paths.db.workspace.prefix')."{$id}</comment>");
            });
        }
    }

    /**
     * @param mixed $slug
     */
    private function dropWorkspace($slug): void
    {
        try {
            $workspace = WorkspaceRepository::getBySlug($slug);
            $this->alert("Dropping workspace {$slug}");

            WorkspaceDatabase::drop($workspace->customer_id);

            $this->newLine();
            $this->info($this->argument('slug').' has gone :boom:');
        } catch (ModelNotFoundException $e) {
            $this->error("Unable to find workspace {$slug}");
        }
    }
}
