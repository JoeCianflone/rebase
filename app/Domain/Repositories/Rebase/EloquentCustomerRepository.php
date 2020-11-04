<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Models\Rebase\Customer\Customer;
use App\Domain\Factories\Rebase\CustomerModelFactory;

class EloquentCustomerRepository extends EloquentRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->cacheKey = 'customer';
    }

    public function factory($model = null)
    {
        return new CustomerModelFactory($model ?? $this->model);
    }
}
