<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\FileCommand;

class MakeModel extends FileCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model {file} {--shared}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stub out a model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = config('app-paths.models');
    }

    public function handle(): void
    {
        $fileName = $this->argument('file');
        $stub = $this->replaceStubParts($this->getStub('Model'), collect([
            "{{classname}}" => $fileName,
            "{{type}}" => $this->option('shared') ? 'shared' : 'workspace',
        ]));

        $fileName = "{$fileName}.php";

        if ($this->toDisk($fileName, $stub)) {
            $this->info("Model created");
        } else {
            $this->info("Model creation halted");
        }
    }
}
