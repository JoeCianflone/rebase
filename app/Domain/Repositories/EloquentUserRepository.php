<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\Traits\EloquentQueries;

class EloquentUserRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'user';

    public function __construct(User $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getKey()
    {
        return $this->cache->getKey();
    }
}
