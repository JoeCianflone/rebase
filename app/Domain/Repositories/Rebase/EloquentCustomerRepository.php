<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Models\Rebase\Customer\Customer;

class EloquentCustomerRepository extends EloquentRepository
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->cacheKey = 'customer';
    }

    public function subscribe(array $subscription): void
    {
        $subscription = collect($subscription);

        $this->row->newSubscription(config('pricing.plan.test'), $subscription->get('plan'))
            ->create(
                $subscription->get('method'),
                $subscription->get('options')
            );

        $this->clearRowModel();
    }
}
