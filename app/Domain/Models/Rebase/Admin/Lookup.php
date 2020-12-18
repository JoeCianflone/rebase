<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Domain\Builders\Rebase\LookupBuilder;
use App\Domain\Factories\Rebase\ModelFactory;
use App\Domain\Models\Rebase\Workspace\Workspace;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lookup extends Model
{
    protected $table = 'lookup';
    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'customer_id',      // required
        'workspace_id',     // required
        'slug',             // required
        'domain',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function workspaces()
    {
        return $this->hasMany(Workspace::class);
    }

    // Model Builder...
    public static function query() : LookupBuilder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query)
    {
        return new LookupBuilder($query);
    }

    // Model Factory...
    public function scopeModelFactory(Builder $builder)
    {
        return new ModelFactory($builder);
    }

}
