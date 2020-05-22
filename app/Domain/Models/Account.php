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
    protected $guarded = [];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'agrees_to_terms_at',
        'agrees_to_privacy_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'uuid',
        'is_business' => 'boolean',
    ];

    public function workspaces(): HasMany
    {
        return $this->hasMany(Workspace::class);
    }
}
