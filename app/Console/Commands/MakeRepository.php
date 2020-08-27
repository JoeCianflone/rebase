<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name} {model?}';

    protected $description = 'Generate a repository/facade';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $modelName = $this->argument('model') ?? $this->argument('name');

        $repo = $this->stubOutRepository($modelName);
        $facade = $this->stubOutFacade($modelName);

        $this->line('<comment>Please make sure you input the following into your RepositoryServiceProvider:</comment>');
        $this->info('$this->app->singleton(\''.$facade->getName().'\', function(Application $app) {
                        return new '.$repo->getName().'(new '.$modelName.'());
                     });');
    }

    private function stubOutFacade(string $modelName): FileGenerator
    {
        $file = (new FileGenerator(Str::replaceFirst('Repository', '', $this->argument('name')), null, 'Repository'))
            ->setFileExtensionAs('php')
            ->setPath(config('app-paths.repositories'), null, 'Facades')
        ;

        $file->hydrate('RepositoryFacade', [
            '{{classname}}' => $file->getName(),
            '{{model}}' => $modelName,
        ]);

        if ($file->writeToDisk()) {
            $this->info('Facade created');
        } else {
            $this->error('Facade already exists');
            exit(1);
        }

        return $file;
    }

    private function stubOutRepository(string $modelName): FileGenerator
    {
        $file = (new FileGenerator(Str::replaceFirst('Repository', '', $this->argument('name')), 'Eloquent', 'Repository'))
            ->setFileExtensionAs('php')
            ->setPath(config('app-paths.repositories'), null)
        ;

        $file->hydrate('Repository', [
            '{{classname}}' => $file->getName(),
            '{{model}}' => ucfirst($modelName),
            '{{cache}}' => strtolower($modelName),
        ]);

        if ($file->writeToDisk()) {
            $this->info('Repository created');
        } else {
            $this->error('Repository already exists');
            exit(1);
        }

        return $file;
    }
}
