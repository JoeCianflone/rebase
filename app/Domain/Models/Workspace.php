<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $connection = 'workspace';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'uuid'
    ];
}
