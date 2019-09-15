<?php

namespace App\Domain\Models;

use App\Domain\Models\Account;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    protected $connection = 'shared';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'account_id' => 'uuid'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
