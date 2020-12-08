<?php

declare(strict_types=1);

namespace App\Domain\Models\Rebase\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Models\Workspace\Workspace;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lookup extends Model
{
    protected $table = 'lookup';
    /**
     * @var array
     */
    protected $fillable = [
        'id',               // required
        'customer_id',      // required
        'workspace_id',     // required
        'slug',             // required
        'domain',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function workspaces()
    {
        return $this->hasMany(Workspace::class);
    }
}
