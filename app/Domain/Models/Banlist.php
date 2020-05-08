<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Banlist extends Model
{
    /**
     * @var string
     */
    protected $connection = 'shared';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'banlist';

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [];
}
