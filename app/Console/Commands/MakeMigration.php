<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:migration {name} {--shared}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a migration';

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
        $name = $this->argument('name');

        $path = $this->option('shared') ? config('database.shared_migrations') : config('database.workspace_migrations');

        $this->call("make:migration", [
            'name' => $name,
            '--path' => $path
        ]);

        exit();
    }
}
