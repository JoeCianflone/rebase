<?php

namespace App\Console\Commands;

use App\Helpers\DBWorkspace;
use App\Domain\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Repositories\Facades\ListingRepository;

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
            $this->callMigration('shared', config('multi-database.shared.migration_path'));
        }

        if ($this->option('workspaces') || $this->option('all')) {
            $listings = ListingRepository::getAll();

            $listings->each(function ($listing) {
                $this->migrateWorkspace($listing);
            });
        }

        if ($this->argument('workspace')) {
            $listing = ListingRepository::getBySlug($this->argument('workspace'));

            $this->migrateWorkspace($listing);
        }
    }

    /**
     * @param Model|Listing $listing
     */
    private function migrateWorkspace($listing): void
    {
        if (!DBWorkspace::exists($listing->account_id)) {
            $this->info("Connection does not exist...creating");
            DBWorkspace::create($listing->account_id);
        }

        DBWorkspace::connect($listing->account_id);

        $this->info("Starting Rollback for: {$listing->slug}");
        $this->callMigration('workspace', config('multi-database.workspace.migration_path'));
    }

    private function callMigration(string $conn, string $path): void
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
