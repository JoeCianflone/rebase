<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $connection = 'shared';

    protected $guarded = [];

    protected $table = 'blacklist';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [ ];
}
