<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompileAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:compile {--production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the compile commands';

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
        passthru("rm -Rf public/assets");
        $this->info("Killed assets...");

        if ($this->option('production')) {
            passthru("yarn run prod");
        } else {
            passthru("yarn run dev");
        }
    }
}
