<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\Helpers\QueryCache;

class EloquentUserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        $this->cache = new QueryCache('user');
        $this->model = $model;
    }
}
