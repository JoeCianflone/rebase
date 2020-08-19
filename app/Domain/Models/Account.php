<?php

namespace App\Domain\Models;

use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use Billable;

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
        'id' => 'uuid',
        'is_business' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'agrees_to_terms_at' => 'datetime',
        'agrees_to_privacy_at' => 'datetime',
    ];

    public function workspaces(): HasMany
    {
        return $this->hasMany(Workspace::class);
    }
}
