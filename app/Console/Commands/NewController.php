<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class NewController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:controller {service} {name} {--view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stub out a controller and view file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = "/app/Domain/Services/";
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->path .= Str::plural($this->argument('service'));

        $realViewName = Str::singular($this->argument('name')) . Str::singular($this->argument('service'));
        $realControllerName = $realViewName . 'Controller';
        $realFileName = "{$realControllerName}.php";

        $namespace = Str::ucfirst(Str::replaceFirst("\\", "", str_replace("/", "\\", $this->path)));
        $namespace .= "\Controllers";

        $stub = $this->replaceStubParts($this->getStub('Controller'), collect([
            "{{class}}" => $realControllerName,
            "{{namespace}}" => $namespace
        ]));



        $this->toDisk("Controllers/{$realFileName}", $stub);
        $this->info("Controller created");

        if ($this->option('view')) {
            $this->call("rebase:view", [
                "service" => $this->argument('service'),
                "name" => $this->argument('name')
            ]);
        }

    }
}
