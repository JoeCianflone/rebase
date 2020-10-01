<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Traits\FindUuidColumns;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspace extends Model
{
    use GeneratesUuid;
    use FindUuidColumns;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'customer_id',       // required
        'name',             // required
        'slug',             // required
        'domain',
        'is_active',        // required
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => EfficientUuid::class,
        'customer_id' => EfficientUuid::class,
        'is_active' => 'boolean',
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
