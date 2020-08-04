<?php

namespace App\Console\Commands;

use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name} {model}';

    protected $description = 'Generate a repository/facade';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $repo = $this->stubOutRepository();
        $facade = $this->stubOutFacade();

        $this->line('<comment>Please make sure you input the following into your RepositoryServiceProvider:</comment>');
        $this->info('$this->app->singleton(\''.$facade->getName().'\', function($app) {
                        return new '.$repo->getName().'(new '.$this->argument('model').'());
                     });');
    }

    private function stubOutFacade(): FileGenerator
    {
        $file = (new FileGenerator($this->argument('name'), null, 'Repository'))
            ->setFileExtensionAs('php')
            ->setPath(config('app-paths.repositories'), null, 'Facades')
        ;
        $file->hydrate('RepositoryFacade', [
            '{{classname}}' => $file->getName(),
        ])
        ;

        if ($file->writeToDisk()) {
            $this->info('Facade created');
        } else {
            $this->error('Facade already exists');
            exit(1);
        }

        return $file;
    }

    private function stubOutRepository(): FileGenerator
    {
        $file = (new FileGenerator($this->argument('name'), 'Eloquent', 'Repository'))
            ->setFileExtensionAs('php')
            ->setPath(config('app-paths.repositories'), null)
        ;
        $file->hydrate('Repository', [
            '{{classname}}' => $file->getName(),
            '{{model}}' => ucfirst($this->argument('model')),
            '{{cache}}' => strtolower($this->argument('model')),
        ])
        ;

        if ($file->writeToDisk()) {
            $this->info('Repository created');
        } else {
            $this->error('Repository already exists');
            exit(1);
        }

        return $file;
    }
}
