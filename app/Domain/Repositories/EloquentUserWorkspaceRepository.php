<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\UserWorkspace;

class EloquentUserWorkspaceRepository extends EloquentRepository
{
    public function __construct(UserWorkspace $model)
    {
        $this->model = $model;
        $this->cacheKey = 'user-workspace';
    }
}
