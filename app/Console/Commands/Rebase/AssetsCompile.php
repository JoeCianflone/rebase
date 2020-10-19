<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;

class AssetsCompile extends Command
{
    protected $signature = 'assets:compile {--production}';

    protected $description = 'Run the compile commands';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        passthru('rm -Rf public/assets');

        $this->info("Cleanup...\n");

        if ($this->option('production')) {
            passthru('yarn run prod');
        } else {
            passthru('yarn run dev');
        }
    }
}
