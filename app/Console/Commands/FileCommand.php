<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

abstract class FileCommand extends Command
{
    protected string $path = "";

    public function __construct()
    {
        parent::__construct();
    }

    abstract public function handle(): void;

    protected function getStub(string $type): ?string
    {
        return rtrim(file_get_contents(base_path("stubs/$type.stub"))) ?? null;
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

    protected function flipSlashes(string $str, bool $reverse = false): string
    {
        if ($reverse) {
            return str_replace('/', '\\', $str);
        }

        return str_replace('\\', '/', $str);
    }

    protected function ucDeconstructPath(string $path): array
    {
        $pathParts = collect(explode('/', $path))->map(function ($item) {
            return ucwords($item);
        });

        return $pathParts->toArray();
    }

    protected function getPathAndNameValues(array $parts): array
    {
        $className = array_pop($parts);
        $namespace = trim(implode("\\", $parts), "\\");
        $path = trim(str_replace("\\", "/", $namespace), "/");

        return [$className, $namespace, $path];
    }

    protected function toDisk(string $name, string $stub): bool
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

        return true;
    }

    protected function setPath($singular, $folder): string
    {
        if ($singular) {
            $folder = "/" . Str::singular($folder);
        } else {
            $folder = "/" . Str::plural($folder);
        }

        return $folder;
    }

    protected function setFileName(string $folder, string $name): string
    {
        return Str::singular($this->argument('folder')) . Str::singular($this->argument('name'));
    }
}
