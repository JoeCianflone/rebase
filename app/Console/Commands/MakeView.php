<?php

namespace App\Console\Commands;

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
        $file = new FileGenerator($this->argument('name'));
        $file->setFileExtensionAs('vue')
            ->setPath(config('app-paths.views'), $this->argument('folder'))
            ->hydrate('View')
        ;

        if ($file->writeToDisk()) {
            $this->info('View created');
        } else {
            $this->error('File already exists');
            exit(1);
        }

        if ($this->option('controller')) {
            $this->call('make:controller', [
                'folder' => $this->argument('folder'),
                'name' => $this->argument('name'),
                '--singular' => $this->option('singular'),
            ]);
        }
    }
}
