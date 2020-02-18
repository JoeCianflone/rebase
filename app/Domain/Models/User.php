<?php

namespace App\Domain\Models;

use App\Enums\UserRole;
use App\Domain\Models\Workspace;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public bool $incrementing = false;

    protected string $connection = 'workspace';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected array $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'id' => 'uuid',
        'workspace_id' => 'uuid',
        'email_verified_at' => 'datetime',
    ];

    public function workspace(): self
    {
       return $this->hasOne(Workspace::class);
    }
}
