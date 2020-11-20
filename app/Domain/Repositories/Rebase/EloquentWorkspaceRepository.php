<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Filters\Rebase\WorkspaceFilters;
use App\Domain\Queries\Rebase\WorkspaceQueries;
use App\Domain\Models\Rebase\Workspace\Workspace;
use App\Domain\Factories\Rebase\WorkspaceModelFactory;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->model = $model;
    }

    public function factory($model = null)
    {
        return new WorkspaceModelFactory($model ?? $this->model);
    }

    public function filter($model)
    {
        return new WorkspaceFilters($model);
    }

    public function query($model = null)
    {
        return new WorkspaceQueries($model ?? $this->model);
    }
}
