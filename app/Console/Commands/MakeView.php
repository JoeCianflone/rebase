<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class MakeView extends FileCommand
{
    protected $signature = 'make:view {folder : path to the view file, will be in Pages}
                                      {name : name of the view file}
                                      {--singular}
                                      {--controller : scaffold out a controller using the same view information}';

    protected $description = 'Stub out a view file';

    public function __construct()
    {
        parent::__construct();
        $this->path = config('app-paths.views');
    }

    public function handle(): void
    {
        $this->path  .= $this->setPath($this->option('singular'), $this->argument('folder'));
        $fileName     = $this->setFileName($this->argument('folder'), $this->argument('name'));
        $fullFileName = "{$fileName}.vue";

        $stub = $this->replaceStubParts($this->getStub('View'));

        $this->toDisk("{$fullFileName}", $stub);
        $this->info("View created");

        if ($this->option('controller')) {
            $this->call("make:controller", [
                "folder" => $this->argument('folder'),
                "name" => $this->argument('name'),
                "--singular" => $this->option('singular'),
            ]);
        }
    }
}
