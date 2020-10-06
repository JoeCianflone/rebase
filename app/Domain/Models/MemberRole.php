<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRole extends Model
{
    protected $connection = 'workspace';

    protected $fillable = [
        'id',
        'workspace_id',
        'member_id',
        'role_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}
