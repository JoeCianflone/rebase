<?php

namespace App\Helpers\Rebase;

class MigrationHelper
{
    public function __construct(private array $options = [])
    {
    }

    public function getOptions(bool $shared = false, bool $rebase = false): array
    {
        return array_merge($this->options, [
            '--step' => true,
            '--force' => true,
            '--path' => $this->path(shared: $shared, rebase: $rebase)
        ]);
    }

    public function path(bool $rebase = false, bool $shared = false)
    {
        $path = config('paths.db.migration_folder');
        $path .= "/";
        $path .= $rebase ? config('paths.namespaces.rebase') : config('paths.namespaces.appspace');
        $path .= "/";
        $path .= $shared ? config('paths.db.shared.migration_path') : config('paths.db.workspace.migration_path');

        return $path;
    }
}
