<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class MakeController extends FileCommand
{
    protected $signature = 'make:controller {folder : What folder inside of Controllers should this go, will create if folder doesn\'t exist}
                                            {name : name for the controller file itself}
                                            {--view : will scaffold out a view file for you using the same information}
                                            {--singular}';

    protected $description = 'Stub out a controller and view file';

    public function __construct()
    {
        parent::__construct();
        $this->path = config('app-paths.controllers');
    }

    public function handle(): void
    {
        $this->path  .= $this->setPath($this->option('singular'), $this->argument('folder'));
        $fileName     = $this->setFileName($this->argument('folder'), $this->argument('name'));
        $fullFileName = "{$fileName}.php";

        $namespace = Str::ucfirst(str_replace("/", "\\", $this->path));

        $stub = $this->replaceStubParts($this->getStub('Controller'), collect([
            "{{class}}" => $fileName,
            "{{namespace}}" => $namespace
        ]));

        $this->toDisk("{$fullFileName}", $stub);
        $this->info("Controller created");

        if ($this->option('view')) {
            $this->call("make:view", [
                "folder" => $this->argument('folder'),
                "name" => $this->argument('name'),
                "--singular" => $this->option('singular'),
            ]);
        }
    }
}
