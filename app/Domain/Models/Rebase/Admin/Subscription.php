<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Admin;

use Illuminate\Database\Eloquent\Builder;
use App\Domain\Factories\Rebase\ModelFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'customer_id',       // required
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
        'quantity' => 'integer',
        'trial_ends_at' => 'datetime',
        'ends_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    // Model Factory...
    public function scopeModelFactory(Builder $builder): ModelFactory
    {
        return new ModelFactory($builder);
    }
}
