<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileGenerator
{
    private string $path;

    private ?string $stub;

    private string $extension;

    private string $name;

    private bool $pluralizeFolders = true;

    private ?string $hydratedStub;

    public function __construct(string $name, ?string $namePrefix = null, ?string $nameSuffix = null)
    {
        $this->name = $name;
        if (null !== $namePrefix) {
            $this->name = $namePrefix.$this->name;
        }

        if (null !== $nameSuffix) {
            $this->name .= $nameSuffix;
        }

        $this->name = trim($this->name);
    }

    public function setFileExtensionAs(string $filetype): self
    {
        if ('.' !== substr($filetype, 0)) {
            $filetype = ".{$filetype}";
        }

        $this->extension = $filetype;

        return $this;
    }

    public function shouldBePlural(bool $pluralizeFolders): self
    {
        $this->pluralizeFolders = $pluralizeFolders;

        return $this;
    }

    public function setPath(string $path, ?string $folders = null): self
    {
        $this->path = $path;

        if (!is_null($folders)) {
            if ($this->pluralizeFolders) {
                $this->path .= ucfirst(Str::plural($folders));
            } else {
                $this->path .= ucfirst(Str::singular($folders));
            }
        }

        return $this;
    }

    public function getName(bool $withExtension = true): string
    {
        if ($withExtension) {
            return "{$this->name}.{$this->extension}";
        }

        return $this->name;
    }

    public function getNamespace(): string
    {
        return Str::ucfirst(str_replace('/', '\\', $this->path));
    }

    // public function setName(string $name, string $extension, bool $useExact = false): void
    // {
    //     if (!$useExact) {
    //         $name = ucfirst(Str::singular($name));
    //     }

    //     $this->name = $this->addPrefixAndSuffixToName(Str::singular($this->folder).$name);
    //     if ('' !== trim($extension)) {
    //         $this->filename = "{$this->name}.".str_replace('.', '', $extension);
    //     } else {
    //         $this->filename = $this->name;
    //     }
    // }

    public function hydrate(string $stub, array $replacements = []): void
    {
        $this->hydratedStub = $this->getStub($stub);

        collect($replacements)->each(function ($item, $key): void {
            $this->hydratedStub = str_replace($key, $item, $this->hydratedStub);
        });
    }

    public function getHydratedStub(): string
    {
        return $this->hydratedStub;
    }

    public function getStub(string $name): ?string
    {
        return rtrim(file_get_contents(base_path("stubs/{$name}.stub"))) ?? null;
    }

    public function writeToDisk(bool $useRoot = false): bool
    {
        $disk = Storage::disk('console');
        if ($useRoot) {
            $disk = Storage::disk('root');
        }

        $file = "{$this->path}/{$this->getName(true)}";

        if ($disk->exists($file)) {
            return false;
        }

        $disk->put($file, $this->hydratedStub);

        return true;
    }
}
