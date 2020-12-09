<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Factories\Rebase\ModelFactory;
use App\Domain\Filters\Rebase\CustomerFilters;
use App\Domain\Filters\Rebase\ModelFilters;
use App\Domain\Queries\Rebase\CustomerQueries;
use App\Domain\Models\Rebase\Admin\Customer;
use App\Domain\Factories\Rebase\CustomerModelFactory;
use App\Domain\Queries\Rebase\ModelQueries;

class EloquentCustomerRepository extends EloquentRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function factory($model = null): ModelFactory
    {
        return new CustomerModelFactory($model ?? $this->model);
    }

    public function filter($model): ModelFilters
    {
        return new CustomerFilters($model);
    }

    public function query($model = null): ModelQueries
    {
        return new CustomerQueries($model ?? $this->model);
    }
}
