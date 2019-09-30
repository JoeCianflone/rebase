<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WatchAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:watch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the watcher';

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
        passthru("rm resources/js/ziggy.js");

        $this->info("Cleanup...\n");
        passthru("yarn run watch");
    }
}
