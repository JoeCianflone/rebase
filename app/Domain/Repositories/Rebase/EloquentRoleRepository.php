<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Factories\Rebase\RoleModelFactory;
use App\Domain\Models\Rebase\Workspace\Role;

class EloquentRoleRepository extends EloquentRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
        $this->cacheKey = 'role';
    }

    public function factory($model = null)
    {
        return new RoleModelFactory($model ?? $this->model);
    }
}
