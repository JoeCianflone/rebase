<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Domain\Builders\Rebase\RoleBuilder;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Collections\Rebase\RoleCollection;
use App\Domain\Factories\Rebase\RoleModelFactory;
use App\Domain\Models\Rebase\Workspace\Workspace;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Traits\Rebase\ModelTransformers\RoleTransformers;

class Role extends Model
{
    // Traits...
    use RoleTransformers;

    // Connection...
    protected $connection = 'workspace';

    // Fillable Attributes...
    protected $fillable = [
        'id',                   // required
        'type',                 // required
        'workspace_id',
        'member_id',            // required
        'created_at',
        'updated_at',
    ];

    // Casts...
    protected $casts = [
        'id' => 'string',
        'member_id' => 'string',
        'workspace_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Global Eager Loads...

    // Relationships....
    public function workspace(): HasOne
    {
        return $this->hasOne(Workspace::class, 'id', 'workspace_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'id', 'member_id');
    }

    // Collection Override....
    public function newCollection(array $models = []): RoleCollection
    {
        return new RoleCollection($models);
    }

    public function newEloquentBuilder($query): RoleBuilder
    {
        return new RoleBuilder($query);
    }

    // Factory...
    public function scopeModelFactory(Builder $builder): RoleModelFactory
    {
        return new RoleModelFactory($builder);
    }

}

