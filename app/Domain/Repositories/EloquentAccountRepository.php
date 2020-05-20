<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Helpers\QueryCache;
use App\Domain\Models\Account;

class EloquentAccountRepository extends EloquentRepository
{
    public function __construct(Account $model)
    {
        $this->cache = new QueryCache('account');
        $this->model = $model;
    }
}
