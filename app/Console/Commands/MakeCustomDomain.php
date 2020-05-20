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
                            {domain: this is the domain you are setting up like, foo.com}
                            {app_root: what is the full app root like, /home/forge/foo.com/public, note you\'re going all the way to the public folder here}
                            {app_domain: what is the normal app domain like, rebase.test, this is the "main domain" where the app is located, has nothing to do with their custom domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to trigger the build steps needed for a new custom domain to be set up for a user';

    protected string $nginxSitesAvailable = '/etc/nginx/sites-available';

    protected string $nginxSitesEnabled = '/etc/nginx/sites-enabled';

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
        $this->call('verify:domain', [
            'domain' => $this->argument('domain'),
        ]);

        $this->call('make:ssl', [
            'domain' => $this->argument('domain'),
        ]);

        $file = new FileGenerator($this->nginxSitesAvailable, true);
        $file->setName($this->argument('domain'), '.conf', true);

        $hydrate = $file->hydrateStub('Nginx', collect([
            '{{domain}}' => $this->argument('domain'),
            '{{app_root}}' => config('domain.root').'/'.$this->argument('domain').'/public',
            '{{app_domain}}' => config('domain.url'),
        ]));

        if ($file->toDisk($hydrate, true)) {
            $this->symlinkFile($file->getFilename());
        } else {
            $this->error($file->getFilename().' already exists');

            exit(1);
        }

        shell_exec('sudo service restart nginx');
    }

    private function symlinkFile(string $filename): void
    {
        $this->info('Symlinking '.$filename);

        $sitesAvailable = $this->nginxSitesAvailable.'/'.$filename;
        $sitesEnabled = $this->nginxSitesEnabled.'/'.$filename;

        shell_exec('ln -s '.$sitesAvailable.' '.$sitesEnabled);
    }
}
