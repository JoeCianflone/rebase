<?php

namespace App\Console\Commands;

use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeController extends Command
{
    protected $signature = 'make:controller {name : name for the controller file itself}
                                            {folder? : What folder inside of Controllers should this go, will create if folder doesn\'t exist}
                                            {--view : will scaffold out a view file for you using the same information}
                                            {--singular}';

    protected $description = 'Stub out a controller and view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = (new FileGenerator($this->argument('name')))
            ->setFileExtensionAs('php')
            ->shouldBeSingular($this->option('singular'))
            ->setPath(config('app-paths.controllers'), $this->argument('folder'))
        ;

        $file->hydrate('Controller', [
            '{{class}}' => $file->getName(),
            '{{namespace}}' => $file->getNamespace(),
        ]);

        if ($file->writeToDisk()) {
            $this->info('Controller created');
        } else {
            $this->error('File already exists');
        }

        if ($this->option('view')) {
            $this->call('make:view', [
                'folder' => $this->argument('folder'),
                'name' => $this->argument('name'),
                '--singular' => $this->option('singular'),
            ]);
        }
    }
}
