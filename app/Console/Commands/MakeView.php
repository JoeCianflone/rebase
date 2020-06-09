<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeView extends Command
{
    protected $signature = 'make:view {name : name of the Vue file}
                                      {folder? : path to the view file inside the js folder}
                                      {--singular}
                                      {--component : use this if you want to make a standard Vue component}
                                      {--renderless : use this if you want to make a renderless component}
                                      {--controller : scaffold out a controller using the same view information}';

    protected $description = 'Stub out a view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = new FileGenerator($this->argument('name'));
        $file->setFileExtensionAs('vue');

        if ($this->option('renderless') && $this->option('component')) {
            $this->error('Pick either a component OR a renderless component');
            exit(1);
        }

        if ($this->option('component')) {
            $file->setPath(config('app-paths.views').'/Components', $this->argument('folder'))
                ->hydrate('VueComponent', [
                    '{{name}}' => Str::slug($file->getName()),
                ])
            ;
        } elseif ($this->option('renderless')) {
            $file->setPath(config('app-paths.views').'/Components', $this->argument('folder'))
                ->hydrate('VueRenderless', [
                    '{{name}}' => Str::slug($file->getName()),
                ])
            ;
        } else {
            $file->setPath(config('app-paths.views').'/Pages', $this->argument('folder'))
                ->hydrate('Vue', [
                    '{{name}}' => $file->getName(),
                ])
            ;
        }

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
