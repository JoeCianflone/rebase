<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\FileGenerator;

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
        $modelName = $this->argument('model');

        $repo = $this->stubOutRepository($modelName);
        $facade = $this->stubOutFacade($modelName);

        $this->line('<comment>Please make sure you input the following into your RepositoryServiceProvider:</comment>');
        $this->newLine();
        $this->info('$this->app->singleton(\''.$facade->getName().'\', function(Application $app) {
                        return new '.$repo->getName().'(new '.$modelName.'());
                     });');
    }

    private function stubOutFacade(string $modelName): FileGenerator
    {
        $file = (new FileGenerator($this->argument('name'), null, 'Repository'))->setFileExtensionAs('php')->setPath(config('rebase-paths.facades'));

        $file->hydrate('repository.facade', [
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
        $file = (new FileGenerator($this->argument('name'), 'Eloquent', 'Repository'))
            ->setFileExtensionAs('php')
            ->setPath(config('rebase-paths.repositories'));

        $file->hydrate('repository', [
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
