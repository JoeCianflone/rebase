<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use Billable;
    use GeneratesUuid;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',                   // required
        'name',                 // required
        'address_line1',        // required
        'address_line2',
        'address_line3',
        'unit_number',
        'city',                 // required
        'state',                // required
        'postal_code',          // required
        'country',
        'is_business',          // false
        'agrees_to_terms_at',
        'agrees_to_privacy_at',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trial_ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => EfficientUuid::class,
        'is_business' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'agrees_to_terms_at' => 'datetime',
        'agrees_to_privacy_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($customer): void {
            $customer->id = (string) Str::uuid();
        });
    }

    public function workspaces(): HasMany
    {
        return $this->hasMany(Workspace::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
    }

    public function uuidColumns(): array
    {
        return  collect($this->casts)->filter(function ($value, $key) {
            return 'Dyrynda\Database\Casts\EfficientUuid' === $value;
        })->keys()->toArray();
    }
}
