<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Admin;

use Illuminate\Support\Str;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use Billable;

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
        'status',
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
            $customer->id = (string)Str::uuid();
        });
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
