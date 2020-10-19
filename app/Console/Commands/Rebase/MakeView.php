<?php

namespace App\Console\Commands\Rebase;

use Illuminate\Console\Command;
use App\Helpers\Rebase\FileGenerator;

class MakeView extends Command
{
    protected $signature = 'make:view {name : name of the Vue file, you can pass deep paths to this Foo/FileName}
                                      {--type=} : Only values can be vue, component or renderless';

    protected $description = 'Stub out a view file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = (new FileGenerator($this->argument('name')))->setPath(config('app-paths.view'))->setFileExtensionAs('vue')->shouldBeSingular(true);

        $type = is_null($this->option('type')) ? '' : '.'.$this->option('type');
        $hydrateFile = 'vue'.$type;

        $file->hydrate($hydrateFile, [
            '{{name}}' => $file->getName(),
        ]);

        if ($file->writeToDisk()) {
            $this->info('View created');
        } else {
            $this->error('File already exists');
            exit(1);
        }
    }
}
