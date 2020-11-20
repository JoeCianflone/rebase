<?php

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Customer\Customer;

class CustomerQueries extends ModelQueries
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'customer';
    }

    public function getCustomerWithSubscriptions(string $customerID)
    {
        return $this->model->where('id', $customerID)->with('subscriptions')->first();
    }
}
