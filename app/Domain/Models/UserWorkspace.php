<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorkspace extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $connection = 'shared';

    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'user_id',          // required
        'account_id',       // required
        'workspace_id',     // required
        'role',             // required
        'create_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'uuid',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
