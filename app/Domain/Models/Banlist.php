<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Banlist extends Model
{
    protected string $connection = 'shared';

    protected array $guarded = [];

    protected string $table = 'banlist';

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    protected array $casts = [ ];
}
