<?php

namespace App\Domain\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'id',
        'first_name',
        'last_name',
        'avatar',
        'email',
        'password',
        'profile',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'uuid',
        'email_verified_at' => 'datetime',
        'profile' => 'json',
    ];

    public function workspace(): void
    {
    }
}
