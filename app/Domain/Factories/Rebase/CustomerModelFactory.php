<?php

namespace App\Domain\Factories\Rebase;

use App\Enums\Rebase\CustomerStatus;
use App\Domain\Models\Rebase\Admin\Customer;

class CustomerModelFactory extends ModelFactory
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function subscribe(array $subscription)
    {
        $subscription = collect($subscription);

        $this->model->newSubscription(config('pricing.plan.test'), $subscription->get('plan'))
            ->create(
                $subscription->get('method'),
                $subscription->get('options')
            );

        return $this->model;
    }

    public function markAsActive()
    {
        $this->update($this->model, ['status' => CustomerStatus::ACTIVE()]);

        return $this->model;
    }
}
