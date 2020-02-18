<?php

namespace App\Console\Commands;


class MakeResource extends GeneratorCommand
{

    protected $signature = 'rebase:resource {service} {name}';

    protected $description = 'Stub out a resource';

    public function __construct()
    {
        parent::__construct();
        $this->path = "/app/Domain/Resources";
    }

    public function handle()
    {
        $stub = $this->replaceStubParts($this->getStub('Resource'), collect([
            "{{classname}}" => $this->argument('name'),
            "{{service}}" => $this->argument('service')
        ]));

        $file =$this->argument('service')."/".$this->argument('name').".php";

        $this->toDisk($file, $stub);
        $this->info("Resource created");
    }
}
