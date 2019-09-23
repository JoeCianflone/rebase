<?php

namespace App\Console\Commands;

use App\Helpers\DBHelper;
use App\Domain\Models\Account;
use Illuminate\Console\Command;
use App\Domain\Repositories\Facades\TenantRepository;
use App\Domain\Repositories\Facades\AccountRepository;

class Explode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:explode {workspace?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up all local DBs';

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
        if (app()->environment() !== 'local') {
            $this->alert("This command only runs in local environments");
            return false;
        }

        if (! $this->argument('workspace')) {
            $this->alert("Refreshing Shared");
            $this->call("migrate:fresh", [
                '--database' => 'shared',
                '--path' => config('database.shared_migrations'),
                '--step' => true
            ]);
        }

        if ($this->argument('workspace')) {
            $this->alert ("Dropping workspace {$this->argument('workspace')}");

            $tenant = TenantRepository::getBySlug($this->argument('workspace'));
            AccountRepository::getById($tenant->account_id);

            $tenant = new DBHelper($this->argument('workspace'));
            $tenant->drop();

            $this->alert("Data go :boom:");
        }

        if ($this->option('all')) {
            $this->alert ("Dropping all workspaces");

            $tenants = new DBHelper();
            $tenants->each(function($tenant) {
                $this->alert("Dropping {$tenant->slug}");
                $tenant->drop();
            });

            $this->alert("Data go :boom:");
        }
    }
}
