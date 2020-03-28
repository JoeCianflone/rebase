<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    /** @var string */
    protected $connection = 'workspace';

    /** @var array */
    protected $guarded = [];

    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /** @var array */
    protected $casts = [
        'id' => 'uuid'
    ];
}
