<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Domain\Factories\Rebase\ModelFactory;

class BannedSubdomain extends Model
{
    /**
     * @var string
     */
    protected $connection = 'shared';

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'sub',             // required
        'reason',
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

    public function scopeSubExists(Builder $builder, string $sub): bool
    {
        return $builder->where('sub', $sub)->exists();
    }

    public function scopeModelFactory(Builder $builder): ModelFactory
    {
        return new ModelFactory($builder);
    }


}
