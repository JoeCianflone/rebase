<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Workspace;
use App\Domain\Repositories\Traits\EloquentQueries;

class EloquentWorkspaceRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'workspace';

    public function __construct(Workspace $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
