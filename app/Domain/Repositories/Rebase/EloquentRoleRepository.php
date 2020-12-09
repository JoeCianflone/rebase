<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Factories\Rebase\ModelFactory;
use App\Domain\Factories\Rebase\RoleModelFactory;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Queries\Rebase\ModelQueries;
use App\Domain\Queries\Rebase\RoleQueries;

class EloquentRoleRepository extends EloquentRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function factory($model = null): ModelFactory
    {
        return new RoleModelFactory($model ?? $this->model);

    }

    public function query($model = null): ModelQueries
    {
        return new RoleQueries($model ?? $this->model);
    }
}
