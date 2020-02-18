<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class NewView extends GeneratorCommand
{

    protected $signature = 'rebase:view {service} {name} {--controller} {--singular}';

    protected $description = 'Stub out a view and controller file';

    public function __construct()
    {
        parent::__construct();
        $this->path = "/resources/js/Pages/";
    }

    public function handle()
    {
        if ($this->option('singular')) {
            $this->path .= Str::singular($this->argument('service'));
        } else {
            $this->path .= Str::plural($this->argument('service'));
        }

        $realViewName = Str::singular($this->argument('name')) . Str::singular($this->argument('service'));
        $realFileName = "{$realViewName}.vue";

        $stub = $this->replaceStubParts($this->getStub('View'));

        $this->toDisk("{$realFileName}", $stub);
        $this->info("View created");

        if ($this->option('controller')) {
            $this->call("rebase:controller", [
                "service" => $this->argument('service'),
                "name" => $this->argument('name'),
                "--singular" => $this->option('singular'),
            ]);
        }

    }
}
