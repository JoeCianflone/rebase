<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    use GeneratesUuid;

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'account_id',       // required
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_plan',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'account_id' => EfficientUuid::class,
        'quantity' => 'integer',
        'trial_ends_at' => 'datetime',
        'ends_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function uuidColumns(): array
    {
        return  collect($this->casts)->filter(function ($value, $key) {
            return 'Dyrynda\Database\Casts\EfficientUuid' === $value;
        })->keys()->toArray();
    }
}
