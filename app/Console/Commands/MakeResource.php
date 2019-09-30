<?php

namespace App\Console\Commands;


class MakeResource extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:resource {service} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stub out a resource';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = "/app/Domain/Services";
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stub = $this->replaceStubParts($this->getStub('Resource'), collect([
            "{{classname}}" => $this->argument('name'),
            "{{service}}" => $this->argument('service')
        ]));

        $file =$this->argument('service')."/Resources/".$this->argument('name').".php";

        $this->toDisk($file, $stub);
        $this->info("Resource created");
    }
}
