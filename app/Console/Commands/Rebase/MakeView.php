<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Rebase\Helpers\FileGenerator;

class MakeView extends Command
{
    protected $signature = 'make:view {name : name of the Vue file, you can pass deep paths to this Foo/FileName}
                                      {--rebase}
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
        $file = (new FileGenerator($this->argument('name')))->setFileExtensionAs('vue')->shouldBeSingular(true);

        if ($this->option('renderless') && $this->option('component')) {
            $this->error('Pick either a component OR a renderless component');
            exit(1);
        }

        if ($this->option('component')) {
            $file = $this->hydrateComponent($file);
        } elseif ($this->option('renderless')) {
            $file = $this->hydrateRenderlessComponent($file);
        } else {
            $file = $this->hydratePage($file);
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
                '--singular' => true,
                '--shared' => $this->option('shared'),
                '--rebase' => $this->option('rebase'),
            ]);
        }
    }

    private function getCorrectPath(string $viewType): string
    {
        if ($this->option('rebase')) {
            return config('app-paths.view').'/'.config('app-paths.views.rebase.'.$viewType);
        }

        return config('app-paths.view').'/'.config('app-paths.views.app.'.$viewType);
    }

    private function hydrateComponent(FileGenerator $file): FileGenerator
    {
        $file
            ->setPath($this->getCorrectPath('components'), null, $this->argument('folder'))
            ->hydrate('VueComponent', [
                '{{name}}' => Str::slug($file->getName()),
            ]);

        return $file;
    }

    private function hydrateRenderlessComponent(FileGenerator $file): FileGenerator
    {
        $file
            ->setPath($this->getCorrectPath('components'), null, $this->argument('folder'))
            ->hydrate('VueRenderless', [
                '{{name}}' => Str::slug($file->getName()),
            ]);

        return $file;
    }

    private function hydratePage(FileGenerator $file): FileGenerator
    {
        $file
            ->setPath($this->getCorrectPath('pages'), $this->option('shared'), $this->argument('folder'))
            ->hydrate('Vue', [
                '{{name}}' => $file->getName(),
            ]);

        return $file;
    }
}
