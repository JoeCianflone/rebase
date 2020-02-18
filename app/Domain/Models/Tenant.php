<?php

namespace App\Domain\Models;

use App\Domain\Models\Account;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected string $connection = 'shared';

    protected array $guarded = [];

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected array $casts = [
        'account_id' => 'uuid'
    ];

    public function account(): self
    {
        return $this->belongsTo(Account::class);
    }
}
