<?php

namespace App\Console\Commands;


class MakeResource extends GeneratorCommand
{

    protected $signature = 'rebase:resource {name}';

    protected $description = 'Stub out a resource';

    public function __construct()
    {
        parent::__construct();
        $this->path = "/app/Http/Resources";
    }

    public function handle()
    {
        $stub = $this->replaceStubParts($this->getStub('Resource'), collect([
            "{{name}}" => $this->argument('name'),
        ]));

        $file = "/".$this->argument('name').".php";

        $this->toDisk($file, $stub);
        $this->info("Resource created");
    }
}
