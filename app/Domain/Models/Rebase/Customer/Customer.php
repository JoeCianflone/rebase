<?php

declare(strict_types=1);

namespace App\Domain\Models\Rebase\Customer;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Facades\Rebase\LookupRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use Billable;

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
        'line1',                // required
        'line2',
        'line3',
        'city',                 // required
        'state',                // required
        'postal_code',          // required
        'country',
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
        'agreed_to_terms' => 'boolean',
        'agreed_to_privacy' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($customer): void {
            $customer->id = (string) Str::uuid();
        });

        // static::created(function ($customer): void {        });

        // static::updated(function ($workspace): void {
        //     LookupRepository::updateWhere(['workspace_id' => $workspace->id], $workspace->toArray());
        // });

        // static::deleted(function ($workspace): void {
        //     LookupRepository::removeWhere(['workspace_id' => $workspace->id]);
        // });
    }

    public function lookup(): HasMany
    {
        return $this->hasMany(Lookup::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class)->orderBy('created_at', 'desc');
    }
}
