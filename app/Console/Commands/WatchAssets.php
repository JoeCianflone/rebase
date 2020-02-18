<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WatchAssets extends Command
{

    protected $signature = 'rebase:watch';

    protected $description = 'Run the watcher';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        passthru("rm -Rf public/assets");
        passthru("rm resources/js/ziggy.js");

        $this->info("Cleanup...\n");
        passthru("yarn run watch");
    }
}
