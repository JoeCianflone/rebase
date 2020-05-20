<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeSSLCert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ssl {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will generate a new SSL cert for a custom domain';

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
            $this->error('Only one domain at a time please');
            exit(1);
        }

        shell_exec('sudo certbot certonly --nginx -d '.$this->argument('domain').' -m '.config('domain.support').' --agree-tos');
        exit(0);
    }
}
