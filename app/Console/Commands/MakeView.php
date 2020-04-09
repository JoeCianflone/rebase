<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeView extends Command
{
    protected $signature = 'make:view {folder : path to the view file, will be in Pages}
                                      {name : name of the view file}
                                      {--singular}
                                      {--controller : scaffold out a controller using the same view information}';

    protected $description = 'Stub out a view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = new FileGenerator(config('app-paths.views'), $this->option('singular'));

        $file->setFolder($this->argument('folder'));
        $file->setName($this->argument('name'), '.vue');

        $hydratedFile = $file->hydrateStub('View');
        if ($file->toDisk($hydratedFile)) {
            $this->info("View created");
        } else {
            $this->error("File already exists");
        }

        if ($this->option('controller')) {
            $this->call("make:controller", [
                "folder" => $this->argument('folder'),
                "name" => $this->argument('name'),
                "--singular" => $this->option('singular'),
            ]);
        }
    }
}
