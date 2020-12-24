<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\Rebase\DatabaseHelper;
use App\Domain\Models\Rebase\Workspace\Workspace;
use App\Domain\Facades\Rebase\WorkspaceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DBExplode extends Command
{
    protected $signature = 'db:explode
                                {sub? : optional name of the workspace you\' like to blow up}
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

        if ($this->argument('sub')) {
            $this->dropWorkspace($this->argument('sub'));
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

        // This will pop up a message saying "nothing to migrate" because after
        // it drops the tables, it can't find any migrations, but it's
        // not supposed to. The migrate:shared will do the migration
        // we use migrate:fresh because it's super convenient
        // to drop all the tables
        $this->call('migrate:fresh');
        $this->call('migrate:shared');

        if ($this->option('seed')) {
            $this->call('db:seed');
        }
    }

    private function dropAllWorkspaces(): void
    {
        $allSpaces = DatabaseHelper::allSpaces(config('paths.db.workspace.prefix'));

        if (!is_null($allSpaces) && $allSpaces->count() > 0) {
            $this->newLine();
            $allSpaces->each(function ($id): void {
                DatabaseHelper::drop($id);

                $this->line('<comment>Dropped: '.config('paths.db.workspace.prefix')."{$id}</comment>");
            });
        }
    }

    private function dropWorkspace(string $sub): void
    {
        try {
            $workspace = Workspace::bySub($sub)->first();
            $this->alert("Dropping workspace {$sub}");

            DatabaseHelper::drop($workspace->customer_id);

            $this->newLine();
            $this->info($this->argument('sub').' has gone :boom:');
        } catch (ModelNotFoundException $e) {
            $this->error("Unable to find workspace {$sub}");
        }
    }
}
