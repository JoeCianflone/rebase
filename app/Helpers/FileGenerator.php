<?php declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FileGenerator
{
    /** @var string */
    private string $path;

    /** @var string|null */
    private ?string $stub;

    /** @var string */
    private string $folder = '';

    /** @var string */
    private string $prefix = '';

    /** @var string */
    private string $suffix = '';

    /** @var string */
    private string $name;

    /** @var string */
    private string $filename;

    /** @var bool|null */
    private ?bool $pluralizeFolders = null;

    /**
     * @param string $path
     * @param boolean $singular
     */
    public function __construct(string $path, ?bool $singular = null)
    {
        $this->path = $path;

        if (! is_null($singular)) {
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

    /**
     * @param string $folder
     * @return void
     */
    public function setFolder(string $folder): void
    {
        if ($this->pluralizeFolders) {
            $this->folder = ucfirst(Str::plural($folder));
        } else {
            $this->folder = ucfirst(Str::singular($folder));
        }
    }

    /**
     * @return string
     */
    public function getFolder(): string
    {
        return $this->folder;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path . '/' . $this->folder;
    }

    /**
     * @param boolean $withExtension
     * @return string
     */
    public function getFilename(bool $withExtension = true): string
    {
        return $withExtension ? $this->filename : $this->name;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return Str::ucfirst(str_replace("/", "\\", $this->getPath()));
    }

    /**
     * @param string $name
     * @param string $extension
     * @return void
     */
    public function setName(string $name, string $extension, bool $useExact = false): void
    {
        if (! $useExact) {
            $name = ucfirst(Str::singular($name));
        }

        $this->name = $this->addPrefixAndSuffixToName(Str::singular($this->folder) . $name);
        if (trim($extension) !== '') {
            $this->filename = "{$this->name}.". str_replace('.', '', $extension);
        } else {
            $this->filename = $this->name;
        }
    }

    /**
     * @param string $name
     * @return string
     */
    private function addPrefixAndSuffixToName(string $name): string
    {
        return $this->prefix . str_replace($this->prefix, '', str_replace($this->suffix, '', $name)) . $this->suffix;
    }

    /**
     * @param string $stub
     * @param Collection|null $replacements
     * @return string
     */
    public function hydrateStub(string $stub, ?Collection $replacements = null): string
    {
        $stub = $this->getStub($stub);

        if (! is_null($replacements)) {
            foreach ($replacements as $key => $value) {
                $stub = str_replace($key, $value, $stub);
            }
        }

        return $stub;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getStub(string $name): ?string
    {
        return rtrim(file_get_contents(base_path("stubs/{$name}.stub"))) ?? null;
    }

    /**
     * @param string $hydratedStub
     * @param boolean $useRoot
     * @return boolean
     */
    public function toDisk(string $hydratedStub, bool $useRoot = false): bool
    {
        $disk = Storage::disk('console');
        if ($useRoot) {
            $disk = Storage::disk('root');
        }

        $file = $this->getPath() . '/' . $this->filename;

        if ($disk->exists($file)) {
            return false;
        }

        $disk->put($file, $hydratedStub);
        return true;
    }
}
