<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;

class AssetsWatch extends Command
{
    protected $signature = 'assets:watch';

    protected $description = 'Run the watcher, this really only exists on the chance the asset pipeline gets complex';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        passthru('rm -Rf public/assets');

        $this->info("Cleanup...\n");
        passthru('yarn run watch');
    }
}
