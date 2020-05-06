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
        $file = new FileGenerator(config('app-paths.models'));
        $file->setName($this->argument('name'), '.php');

        $hydratedFile = $file->hydrateStub('Model', collect([
            '{{classname}}' => $file->getFilename(false),
            '{{type}}' => $this->option('shared') ? 'shared' : 'workspace',
        ]));

        if ($file->toDisk($hydratedFile)) {
            $this->info('Model created');
        } else {
            $this->error('File already exists');
        }
    }
}
