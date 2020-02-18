<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected string $connection = 'workspace';

    protected array $guarded = [];

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected array $casts = [
        'id' => 'uuid'
    ];
}
