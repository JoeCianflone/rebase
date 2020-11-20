<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Filters\Rebase\CustomerFilters;
use App\Domain\Queries\Rebase\CustomerQueries;
use App\Domain\Models\Rebase\Customer\Customer;
use App\Domain\Factories\Rebase\CustomerModelFactory;

class EloquentCustomerRepository extends EloquentRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function factory($model = null)
    {
        return new CustomerModelFactory($model ?? $this->model);
    }

    public function filter($model)
    {
        return new CustomerFilters($model);
    }

    public function query($model = null)
    {
        return new CustomerQueries($model ?? $this->model);
    }
}
