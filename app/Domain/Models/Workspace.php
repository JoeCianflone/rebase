<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspace extends Model
{
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
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($workspace): void {
            $workspace->id = (string) Str::uuid();
        });
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function members(): void
    {
        $this->belongsToMany(Member::class)->using(MemberWorkspace::class);
    }
}
