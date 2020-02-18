<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class GeneratorCommand extends Command
{

    protected $path = "";

    public function __construct()
    {
        parent::__construct();
    }

    abstract public function handle();


    protected function getStub(string $type): string
    {
        return rtrim(file_get_contents(base_path("stubs/$type.stub")));
    }

    protected function replaceStubParts(string $stub, ?Collection $replacements = null): string
    {
        $hydratedStub = $stub;

        if (! is_null($replacements)) {
            foreach ($replacements as $key => $value) {
                $hydratedStub = str_replace($key, $value, $hydratedStub);
            }
        }

        return $hydratedStub;
    }

    protected function flipSlashes(string $path): string
    {
        return str_replace('\\', '/', $path);
    }

    protected function ucDeconstructPath(string $path): array
    {
        $pathParts = collect(explode('/', $path))->map(function($item) {
            return ucwords($item);
        });

        return $pathParts->toArray();
    }

    protected function getPathAndNameValues(array $parts): array
    {
        $className = array_pop($parts);
        $namespace = trim(implode("\\", $parts), "\\");
        $path = trim(str_replace("\\", "/",$namespace), "/");

        return [$className, $namespace, $path];
    }

    protected function toDisk($name, $stub)
    {
        $disk = Storage::disk('console');
        $file = "{$this->path}/{$name}";

        if ($disk->exists($file)) {
            if ($this->confirm("File already exists, overwrite?")) {
                $disk->put($file, $stub);
            }

            return false;
        }

        $disk->put($file, $stub);

    }
}
