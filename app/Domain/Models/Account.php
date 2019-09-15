<?php

namespace App\Domain\Models;

use App\Domain\Models\Tenant;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Billable;

    public $incrementing = false;

    protected $connection = 'shared';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'uuid'
    ];

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }
}
