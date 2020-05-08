<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\User;

class EloquentUserRepository extends EloquentRepository
{
    protected string $cacheKey = 'user';

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
