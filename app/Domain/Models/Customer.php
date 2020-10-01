<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use App\Domain\Traits\FindUuidColumns;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use Billable;
    use GeneratesUuid;
    use FindUuidColumns;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $connection = 'shared';

    /**
     * @var array
     */
    protected $fillable = [
        'id',                   // required
        'name',                 // required
        'agreed_to_terms',      // required
        'agreed_to_privacy',    // required
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
        'agreed_to_terms' => 'boolean',
        'agreed_to_privacy' => 'boolean',
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

    public function customerAddresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
    }

    public function uuidColumns(): array
    {
        return $this->allUuidColumns($this->casts);
    }
}
