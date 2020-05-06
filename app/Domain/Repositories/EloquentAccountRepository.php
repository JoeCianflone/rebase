<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Account;
use App\Domain\Repositories\Traits\EloquentQueries;

class EloquentAccountRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'account';

    public function __construct(Account $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
