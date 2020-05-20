<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
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
    protected $guarded = [];

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
    protected $casts = [
        'id' => 'uuid',
    ];
}
