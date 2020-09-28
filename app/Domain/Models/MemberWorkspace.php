<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;

class MemberWorkspace extends Model
{
    use GeneratesUuid;

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
        'id' => EfficientUuid::class,
        'user_id' => EfficientUuid::class,
        'account_id' => EfficientUuid::class,
        'workspace_id' => EfficientUuid::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function uuidColumns(): array
    {
        return  collect($this->casts)->filter(function ($value, $key) {
            return 'Dyrynda\Database\Casts\EfficientUuid' === $value;
        })->keys()->toArray();
    }
}
