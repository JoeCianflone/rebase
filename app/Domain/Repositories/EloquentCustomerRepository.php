<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Customer;

class EloquentCustomerRepository extends EloquentRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->cacheKey = 'customer';
    }
}
