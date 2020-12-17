<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Enums\Rebase\WorkspaceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Facades\Rebase\LookupRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Factories\Rebase\WorkspaceModelFactory;
use App\Domain\Traits\Rebase\ModelTransformers\WorkspaceTransformers;

class Workspace extends Model
{
    use WorkspaceTransformers;

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
                Lookup::modelFactory()->update('workspace_id', $workspace->id, [
                    'slug' => $workspace->slug,
                    'domain' => $workspace->domain,
                ]);
            }
        });

        static::deleted(function ($workspace): void {
            Lookup::modelFactory()->remove('workspace_id', '=', $workspace->id);
        });
    }

    // Relations...
    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    // Model Factory...
    public function scopeModelFactory(Builder $builder)
    {
        return new WorkspaceModelFactory($builder);
    }

    public function scopeBySlug(Builder $builder, string $slug) {
        return $builder->where('slug', $slug);
    }


    // public function getWorkspacesAndMembers(?int $paginate = null, ?string $searchTerm = null, array $searchFields = [], ?string $order = null, string $direction = 'asc')
    // {
    //     $builder = $this->buildSearch(
    //         builder: $this->model::with('members'),
    //         searchTerm: $searchTerm,
    //         searchFields: $searchFields
    //     );

    //     $builder = $this->buildOrder($builder, $order, $direction);

    //     return $this->getOrPaginate($builder, $paginate);
    // }






}
