<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    /** @var string */
    protected $connection = 'shared';

    /** @var array */
    protected $guarded = [];

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /** @var array */
    protected $casts = [
        'account_id' => 'uuid',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
