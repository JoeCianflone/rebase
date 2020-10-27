<?php

namespace App\Helpers\Rebase;

class MigrationHelper
{
    private array $options = [];
    private bool $isRebaseMigration = false;

    public function __construct(bool $isRebaseMigration = false)
    {
        $this->isRebaseMigration = $isRebaseMigration;
        $this->options = [
            '--step' => true,
            '--force' => true,
        ];
    }

    public function configurePath(bool $isWorkspaceMigration = false): self
    {
        $this->addOptions([
            '--path' => config($this->setMigrationPath($isWorkspaceMigration)),
        ]);

        return $this;
    }

    public function addOptions(array $newOptions): self
    {
        $this->options = array_merge($this->options, $newOptions);

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    private function setMigrationPath(bool $isWorkspaceMigration = false): string
    {
        $type = $isWorkspaceMigration ? 'workspace' : 'shared';
        $rebase = $this->isRebaseMigration ? 'rebase_' : '';

        return "rebase-paths.db.{$type}.{$rebase}migration_path";
    }
}
