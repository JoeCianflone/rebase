<?php

namespace App\Domain\Models;

use Laravel\Cashier\Billable;
use App\Domain\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use Billable;

    /** @var string */
    protected $connection = 'shared';

    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $guarded = [];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /** @var array */
    protected $casts = [
        'id' => 'uuid'
    ];

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
