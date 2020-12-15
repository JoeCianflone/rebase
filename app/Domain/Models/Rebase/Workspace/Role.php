<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Models\Rebase\Workspace\Workspace;


/**
 * @property array|mixed data
 */
class Role extends Model
{
    /**
     * @var string
     */
    protected $connection = 'workspace';

    /**
     * @var array
     */
    protected $fillable = [
        'id',                   // required
        'type',                 // required
        'workspace_id',
        'member_id',           // required
        'created_at',
        'updated_at',
    ];

    protected $with = ['workspace'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'member_id' => 'string',
        'workspace_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function workspace() {
        return $this->hasOne(Workspace::class, 'id', 'workspace_id');
    }

    public function members() {
        return $this->hasMany(Member::class, 'id', 'member_id');
    }

}
