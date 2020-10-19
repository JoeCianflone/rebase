<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Rebase\Helpers\FileGenerator;

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
     */
    public function handle(): void
    {
        $this->call('verify:domain', [
            'domain' => $this->argument('domain'),
        ]);

        $this->call('make:ssl', [
            'domain' => $this->argument('domain'),
        ]);

        $file = (new FileGenerator($this->nginxSitesAvailable))
            ->setFileExtensionAs('conf')
            ->shouldBeSingular(true)
            ->setPath(config('app-paths.nginx'), null, 'sites-available');

        $file->hydrate('Nginx', [
            '{{domain}}' => $this->argument('domain'),
            '{{app_root}}' => config('domain.root').'/'.$this->argument('domain').'/public',
            '{{app_domain}}' => config('domain.url'),
        ]);

        if ($file->writeToDisk()) {
            $this->symlinkFile($file->getFileName());
        } else {
            $this->error($file->getFileName().' already exists');

            exit(1);
        }

        /** @psalm-suppress ForbiddenCode */
        shell_exec('sudo service restart nginx');
    }

    private function symlinkFile(string $filename): void
    {
        $this->info('Symlinking '.$filename);

        $sitesAvailable = config('app-paths.nginx').'sites-available/'.$filename;
        $sitesEnabled = config('app-paths.nginx').'sites-enabled/'.$filename;

        /**  @psalm-suppress ForbiddenCode */
        shell_exec('ln -s '.$sitesAvailable.' '.$sitesEnabled);
    }
}
