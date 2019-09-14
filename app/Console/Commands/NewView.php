<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;

class NewView extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebase:view {service} {name} {--controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stub out a view and controller file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = "/resources/js/Pages/";
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
        $realFileName = "{$realViewName}.vue";

        $stub = $this->replaceStubParts($this->getStub('View'));

        $this->toDisk("{$realFileName}", $stub);
        $this->info("View created");

        if ($this->option('controller')) {
            $this->call("rebase:controller", [
                "service" => $this->argument('service'),
                "name" => $this->argument('name')
            ]);
        }

    }
}
