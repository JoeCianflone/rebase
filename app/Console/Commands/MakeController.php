<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeController extends Command
{
    protected $signature = 'make:controller {folder : What folder inside of Controllers should this go, will create if folder doesn\'t exist}
                                            {name : name for the controller file itself}
                                            {--view : will scaffold out a view file for you using the same information}
                                            {--singular}';

    protected $description = 'Stub out a controller and view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = new FileGenerator(config('app-paths.controllers'), $this->option('singular'));

        $file->setFolder($this->argument('folder'));
        $file->setName($this->argument('name'), '.php');

        $hydratedFile = $file->hydrateStub('Controller', collect([
            "{{class}}" => $file->getFilename(false),
            "{{namespace}}" => $file->getNamespace(),
        ]));

        if ($file->toDisk($hydratedFile)) {
            $this->info("Controller created");
        } else {
            $this->error("File already exists");
        }

        if ($this->option('view')) {
            $this->call("make:view", [
                "folder" => $this->argument('folder'),
                "name" => $this->argument('name'),
                "--singular" => $this->option('singular'),
            ]);
        }
    }
}
