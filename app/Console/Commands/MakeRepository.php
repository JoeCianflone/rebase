<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\FileGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        $repo = $this->stubOutRepository(new FileGenerator(config('app-paths.repositories'), false));
        $facade = $this->stubOutFacade(new FileGenerator(config('app-paths.repositories'), false));

        $this->line('<comment>Please make sure you input the following into your RepositoryServiceProvider:</comment>');
        $this->info('$this->app->singleton(\''.$repo->getFilename(false).'\', function($app) {
                        return new '.$facade->getFilename(false).'(new '.$this->argument('model').'());
                     });');
    }


    private function stubOutFacade(FileGenerator $file): FileGenerator
    {
        $file->setNameSuffix('Repository');

        $file->setName($this->argument('name'), '.php');
        $file->setFolder('Facades');

        $hydratedFacade = $file->hydrateStub('RepositoryFacade', collect([
            "{{classname}}" => $file->getFilename(false),
        ]));

        if ($file->toDisk($hydratedFacade)) {
            $this->info("Facade created");
        } else {
            $this->error("Facade already exists");
        }

        return $file;
    }

    private function stubOutRepository(FileGenerator $file): FileGenerator
    {
        $file->setNamePrefix('Eloquent');
        $file->setNameSuffix('Repository');
        $file->setName($this->argument('name'), '.php');

        $hydratedFile = $file->hydrateStub('Repository', collect([
            "{{classname}}" => $file->getFilename(false),
            "{{model}}" => ucfirst($this->argument('model')),
            "{{cache}}" => strtolower($this->argument('model')),
        ]));

        if ($file->toDisk($hydratedFile)) {
            $this->info("Repository created");
        } else {
            $this->error("Repository already exists");
        }

        return $file;
    }
}
