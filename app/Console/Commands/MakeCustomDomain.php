<?php

namespace App\Console\Commands;

use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeCustomDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain
                            {name: this is the domain you are setting up like, foo.com}
                            {app_root: what is the full app root like, /home/forge/foo.com/public, note you\'re going all the way to the public folder here}
                            {app_domain: what is the normal app domain like, rebase.test, this is the "main domain" where the app is located, has nothing to do with their custom domain}
                            {support_email: certbot needs an email, this should NOT be the customer, this is an IT email address so you know something is up if something happens to a cert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        exec('sudo certbot certonly --nginx -d '.$this->argument('name').' -m '.$this->argument('support_email').' --agree-tos');

        $file = new FileGenerator('/etc/nginx/sites-available', true);
        $file->setName($this->argument('name'), '', true);

        $hydrate = $file->hydrateStub('Nginx', collect([
            '{{domain}}' => $this->argument('name'),
            '{{app_root}}' => $this->argument('app_root'),
            '{{app_domain}}' => $this->argument('app_domain'),
        ]));

        if ($file->toDisk($hydrate, true)) {
            $this->info('nginx conf created');
        } else {
            $this->error('File already exists');
        }

        exec('sudo service restart nginx');
    }
}
