<?php

namespace App\Console\Commands;

class NewRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:repository {name} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = "app/Domain/Repositories";
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $facade = $this->replaceStubParts($this->getStub('RepositoryFacade'), collect([
            "{{classname}}" => $this->argument('name'),
        ]));

        $eloquent = $this->replaceStubParts($this->getStub('EloquentRepository'), collect([
            "{{classname}}" => $this->argument('name'),
            "{{model}}" => $this->argument('model'),
        ]));

        $eloquentFile = "Eloquent".$this->argument('name').".php";
        $facadeFile = "Facades/". $this->argument('name').".php";

        $this->toDisk($eloquentFile, $eloquent);
        $this->toDisk($facadeFile, $facade);

        $this->info("Repository created...remember to add the singleton to the RepositoryServiceProvider: \n");

$this->info('$this->app->singleton(\''.$this->argument('name').'\', function($app) {
    return new Eloquent'.$this->argument('name').'(new '.$this->argument('model').'());
});');
    }
}
