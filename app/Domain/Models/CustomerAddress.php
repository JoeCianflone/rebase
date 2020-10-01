<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Traits\FindUuidColumns;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerAddress extends Model
{
    use GeneratesUuid;
    use FindUuidColumns;
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
        'id',
        'customer_id',
        'is_primary',
        'line1',
        'line2',
        'line3',
        'city',
        'state',
        'postal_code',
        'country',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'customer_id' => EfficientUuid::class,
        'is_primary' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function uuidColumns(): array
    {
        return $this->allUuidColumns($this->casts);
    }
}
