<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeMigration extends Command
{
    protected $signature = 'rebase:migration {name} {--shared}';

    protected $description = 'Generates a migration';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $path = $this->option('shared') ? config('database.shared_migrations') : config('database.workspace_migrations');

        $this->call("make:migration", [
            'name' => $this->argument('name'),
            '--path' => $path
        ]);

        exit();
    }
}
