<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Factories\Rebase\ModelFactory;
use App\Domain\Filters\Rebase\ModelFilters;
use App\Domain\Filters\Rebase\WorkspaceFilters;
use App\Domain\Queries\Rebase\ModelQueries;
use App\Domain\Queries\Rebase\WorkspaceQueries;
use App\Domain\Models\Rebase\Workspace\Workspace;
use App\Domain\Factories\Rebase\WorkspaceModelFactory;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->model = $model;
    }

    public function factory($model = null): ModelFactory
    {
        return new WorkspaceModelFactory($model ?? $this->model);
    }

    public function filter($model): ModelFilters
    {
        return new WorkspaceFilters($model);
    }

    public function query($model = null): ModelQueries
    {
        return new WorkspaceQueries($model ?? $this->model);
    }
}
