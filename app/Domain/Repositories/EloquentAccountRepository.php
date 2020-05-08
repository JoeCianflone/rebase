<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Account;

class EloquentAccountRepository extends EloquentRepository
{
    protected string $cacheKey = 'account';

    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
