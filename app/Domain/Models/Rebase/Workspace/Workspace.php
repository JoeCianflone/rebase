<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Enums\Rebase\WorkspaceStatus;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Models\Rebase\Admin\Lookup;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Builders\Rebase\WorkspaceBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Factories\Rebase\WorkspaceModelFactory;
use App\Domain\Traits\Rebase\ModelTransformers\WorkspaceTransformers;

class Workspace extends Model
{
    use WorkspaceTransformers;

    public $incrementing = false;

    protected $connection = 'workspace';

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

    protected $casts = [
        'activation_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($workspace): void {
            $workspace->id = (string)Str::uuid();
            $workspace->activation_token = (string)Str::uuid();
            $workspace->activation_at = Carbon::now();
        });

        static::created(function ($workspace): void {
            Lookup::modelFactory()->create([
                'workspace_id' => $workspace->id,
                'customer_id' => $workspace->customer_id,
                'slug' => $workspace->slug,
                'domain' => $workspace->domain,
            ]);
        });

        static::updated(function ($workspace): void {
            if ($workspace->isDirty('domain', 'slug')) {
                Lookup::modelFactory()->update(
                    whereCol:'workspace_id',
                    whereValue: $workspace->id,
                    update: [
                        'slug' => $workspace->slug,
                        'domain' => $workspace->domain,
                    ]
                );
            }
        });

        static::deleted(function ($workspace): void {
            Lookup::modelFactory()->remove(ids: [$workspace->id]);
        });
    }

    // Relations...
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

    public function newEloquentBuilder($query): WorkspaceBuilder
    {
        return new WorkspaceBuilder($query);
    }

    // Model Factory...
    public function scopeModelFactory(Builder $builder): WorkspaceModelFactory
    {
        return new WorkspaceModelFactory($builder);
    }

}
