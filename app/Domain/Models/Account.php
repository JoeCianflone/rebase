<?php

namespace App\Domain\Models;

use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;

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
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'uuid',
        'is_business' => 'boolean',
    ];
}
