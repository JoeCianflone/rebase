<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use App\Enums\Rebase\CustomerStatus;
use App\Domain\Models\Rebase\Admin\Customer;

class CustomerModelFactory extends ModelFactory
{

    public function subscribe(array $subscription): ?Customer
    {
        $subscription = collect($subscription);

        $this->builder->newSubscription(config('pricing.plan.test'), $subscription->get('plan'))
            ->create(
                $subscription->get('method'),
                $subscription->get('options')
            );

        return $this->builder;
    }

    public function markAsActive(): ?Customer
    {
        $this->builder->update(['status' => CustomerStatus::ACTIVE()]);

        return $this->builder;
    }
}
