<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Traits\FindUuidColumns;
use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;

class MemberWorkspace extends Model
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
    protected $connection = 'workspace';

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'user_id',          // required
        'workspace_id',     // required
        'role',             // required
        'create_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => EfficientUuid::class,
        'workspace_id' => EfficientUuid::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function member() {
        return $this->hasOne(Member::class);
    }

    public function workspace() {
        return $this->hasOne(Workspace::class)
    }

    public function uuidColumns(): array
    {
        return $this->allUuidColumns($this->casts);
    }
}
