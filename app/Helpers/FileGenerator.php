<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FileGenerator
{
    private string $path;

    private ?string $stub;

    private string $folder = '';

    private string $prefix = '';

    private string $suffix = '';

    private string $name;

    private string $filename;

    private ?bool $pluralizeFolders = null;

    private ?string $hydratedStub;

    /**
     * @param bool $singular
     */
    public function __construct(string $path, ?bool $singular = null)
    {
        $this->path = $path;

        if (!is_null($singular)) {
            $this->pluralizeFolders = $singular ? false : true;
        }
    }

    public function setNamePrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function setNameSuffix(string $suffix): void
    {
        $this->suffix = $suffix;
    }

    public function setFolder(string $folder): void
    {
        if ($this->pluralizeFolders) {
            $this->folder = ucfirst(Str::plural($folder));
        } else {
            $this->folder = ucfirst(Str::singular($folder));
        }
    }

    public function getFolder(): string
    {
        return $this->folder;
    }

    public function getPath(): string
    {
        return $this->path.'/'.$this->folder;
    }

    public function getFilename(bool $withExtension = true): string
    {
        return $withExtension ? $this->filename : $this->name;
    }

    public function getNamespace(): string
    {
        return Str::ucfirst(str_replace('/', '\\', $this->getPath()));
    }

    public function setName(string $name, string $extension, bool $useExact = false): void
    {
        if (!$useExact) {
            $name = ucfirst(Str::singular($name));
        }

        $this->name = $this->addPrefixAndSuffixToName(Str::singular($this->folder).$name);
        if ('' !== trim($extension)) {
            $this->filename = "{$this->name}.".str_replace('.', '', $extension);
        } else {
            $this->filename = $this->name;
        }
    }

    public function hydrateStub(string $stub, ?Collection $replacements = null): void
    {
        $stub = $this->getStub($stub);

        if (!is_null($replacements)) {
            foreach ($replacements as $key => $value) {
                $stub = str_replace($key, $value, $stub);
            }
        }

        $this->hydratedStub = $stub;
    }

    public function getHydratedStub(): string
    {
        return $this->hydratedStub;
    }

    public function getStub(string $name): ?string
    {
        return rtrim(file_get_contents(base_path("stubs/{$name}.stub"))) ?? null;
    }

    public function toDisk(bool $useRoot = false): bool
    {
        $disk = Storage::disk('console');
        if ($useRoot) {
            $disk = Storage::disk('root');
        }

        $file = $this->getPath().'/'.$this->filename;

        if ($disk->exists($file)) {
            return false;
        }

        $disk->put($file, $this->hydratedStub);

        return true;
    }

    private function addPrefixAndSuffixToName(string $name): string
    {
        return $this->prefix.str_replace($this->prefix, '', str_replace($this->suffix, '', $name)).$this->suffix;
    }
}
