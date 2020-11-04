<?php

declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Facades\Rebase\LookupRepository;

class Workspace extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    protected $connection = 'workspace';

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'customer_id',      // required
        'name',             // required
        'slug',             // required
        'domain',
        'status',           // required
        'activation_token',
        'activation_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'activation_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($workspace): void {
            $workspace->id = (string) Str::uuid();
            $workspace->activation_token = (string) Str::uuid();
            $workspace->activation_at = Carbon::now();
        });

        static::created(function ($workspace): void {
            LookupRepository::factory()->create([
                'workspace_id' => $workspace->id,
                'customer_id' => $workspace->customer_id,
                'slug' => $workspace->slug,
                'domain' => $workspace->domain,
            ]);
        });

        static::updated(function ($workspace): void {
            if ($workspace->isDirty('domain', 'slug')) {
                LookupRepository::factory()->update('workspace_id', $workspace->id, [
                    'slug' => $workspace->slug,
                    'domain' => $workspace->domain,
                ]);
            }
        });

        static::deleted(function ($workspace): void {
            LookupRepository::factory()->remove('workspace_id', '=', $workspace->id);
        });
    }

    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot('role');
    }
}
