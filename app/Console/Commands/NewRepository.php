<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class NewRepository extends FileCommand
{
    protected $signature = 'rebase:repository {name} {model?}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
        $this->path = config('app-paths.repositories');
    }

    public function handle(): void
    {
        $name = $this->argument('name');
        $model = $this->argument('model') ?: $this->argument('name');

        if (! Str::endsWith($this->argument('name'), 'Repository')) {
            $name = $this->argument('name') . "Repository";
        }

        $facade = $this->replaceStubParts($this->getStub('RepositoryFacade'), collect([
            "{{classname}}" => $name,
        ]));

        $eloquent = $this->replaceStubParts($this->getStub('EloquentRepository'), collect([
            "{{classname}}" => $name,
            "{{model}}" => $model,
        ]));

        $eloquentFile = "Eloquent".$name.".php";
        $facadeFile = "Facades/". $name.".php";

        $this->toDisk($eloquentFile, $eloquent);
        $this->toDisk($facadeFile, $facade);

        $this->info("Repository created...remember to add the singleton to the RepositoryServiceProvider: \n");

        $this->info('$this->app->singleton(\''.$name.'\', function($app) {
            return new Eloquent'.$name.'(new '.$model.'());
        });');
    }
}
