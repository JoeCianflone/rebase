<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Admin\Customer;

class CustomerQueries extends ModelQueries
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'customer';
    }

    public function getCustomerWithSubscriptions(string $customerID): Customer
    {
        return $this->model::with('subscriptions')->where('id', $customerID)->first();
    }
}
