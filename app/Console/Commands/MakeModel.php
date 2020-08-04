<?php

namespace App\Console\Commands;

use App\Helpers\FileGenerator;
use Illuminate\Console\Command;

class MakeModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model {name} {--shared}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stub out a model';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $file = (new FileGenerator($this->argument('name')))
            ->setFileExtensionAs('php')
            ->setPath(config('app-paths.models'), null)
        ;
        $file->hydrate('Model', [
            '{{classname}}' => $file->getName(),
            '{{type}}' => $this->option('shared') ? 'shared' : 'workspace',
        ])
        ;

        if ($file->writeToDisk()) {
            $this->info('Model created');
        } else {
            $this->error('File already exists');
            exit(1);
        }
    }
}
