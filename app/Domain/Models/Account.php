<?php

namespace App\Domain\Models;

use App\Domain\Models\Tenant;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Billable;

    public bool $incrementing = false;

    protected string $connection = 'shared';

    protected array $guarded = [];

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected array $casts = [
        'id' => 'uuid'
    ];

    public function tenant(): self
    {
        return $this->hasOne(Tenant::class);
    }
}
