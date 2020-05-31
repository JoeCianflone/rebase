<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class VerifyDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:domain {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify that the domain is on our servers';

    /**
     * Create a new command instance.
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
        if (!is_string($this->argument('domain'))) {
            $this->error('Domain must be a string');
            exit(1);
        }

        $domainIP = gethostbyname($this->argument('domain'));

        if ($domainIP !== config('domain.ip1')) {
            $this->error($this->argument('domain').' is not currently pointing to our IP address');
            exit(1);
        }

        $this->info('Domain is pointing to our servers!');
    }
}
