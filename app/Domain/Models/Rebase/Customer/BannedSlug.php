<?php

declare(strict_types=1);

namespace App\Domain\Models\Rebase\Customer;

use Illuminate\Database\Eloquent\Model;

class BannedSlug extends Model
{
    /**
     * @var string
     */
    protected $connection = 'shared';

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'slug',             // required
        'reason',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
