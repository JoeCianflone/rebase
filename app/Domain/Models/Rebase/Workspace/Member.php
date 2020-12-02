<?php

declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
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
        'id',                   // required
        'email',                // required
        'password',
        'name',                 // required
        'avatar',
        'profile',
        'roles',
        'remember_token',
        'email_token',
        'email_verified_at',
        'created_at',
        'updated_at',
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
        'id' => 'string',
        'email_token' => 'string',
        'profile' => 'array',
        'roles' => 'array',
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($member): void {
            $member->id = (string) Str::uuid();
            $member->email_token = (string) Str::uuid();
        });
    }

    public function role(string $key): string
    {
        return collect($this->roles)->firstWhere('workspace_id', $key)['type'];
    }

    public function workspaces()
    {
        return $this->belongsToMany(Workspace::class);
    }
}
