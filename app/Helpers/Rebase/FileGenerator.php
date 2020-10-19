<?php

declare(strict_types=1);

namespace App\Helpers\Rebase;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileGenerator
{
    private string $path;

    private ?string $stub;

    private string $userPath = '';

    private string $extension;

    private string $name;

    private bool $isSingular = false;

    private ?string $hydratedStub;

    public function __construct(string $name, ?string $namePrefix = null, ?string $nameSuffix = null)
    {
        // Auth/GetThing

        $name = explode('/', $name);

        $this->name = array_pop($name);
        $this->userPath = implode('/', $name);

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

    public function shouldBeSingular(?bool $isSingular = null): self
    {
        $this->isSingular = $isSingular ?? false;

        return $this;
    }

    public function setPath(string $path, ?bool $useShared, ?string $folders = null): self
    {
        $this->path = $path.'/';

        if (!is_null($useShared) && false === $useShared) {
            $this->path .= config('app-paths.workspace').'/';
            $this->path .= $this->userPath.'/';
        }

        if (!is_null($folders)) {
            if ($this->isSingular) {
                $this->path .= ucfirst(Str::singular($folders));
            } else {
                $this->path .= ucfirst(Str::plural($folders));
            }
        }

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFileName(): string
    {
        return "{$this->name}{$this->extension}";
    }

    public function getNamespace(): string
    {
        return Str::ucfirst(str_replace('/', '\\', $this->path));
    }

    public function hydrate(string $stub, array $replacements = []): void
    {
        $this->hydratedStub = $this->getStub($stub);

        collect($replacements)->each(function ($item, $key): void {
            $this->hydratedStub = str_replace($key, $item, $this->hydratedStub);
        });
    }

    public function getHydratedStub(): ?string
    {
        return $this->hydratedStub;
    }

    public function getStub(string $name): ?string
    {
        return rtrim(file_get_contents(base_path("stubs/{$name}.stub"))) ?: null;
    }

    public function writeToDisk(bool $useRoot = false): bool
    {
        $disk = Storage::disk('console');
        if ($useRoot) {
            $disk = Storage::disk('root');
        }

        $file = "{$this->path}/{$this->getFileName()}";

        if ($disk->exists($file)) {
            return false;
        }

        $disk->put($file, $this->hydratedStub);

        return true;
    }
}
