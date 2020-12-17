<?php declare(strict_types=1);

namespace App\Domain\Models\Rebase\Workspace;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Domain\Models\Rebase\Workspace\Role;
use App\Domain\Factories\Rebase\MemberModelFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($member): void {
            $member->id = (string)Str::uuid();
            $member->email_token = (string)Str::uuid();
        });
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function workspaces(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class);
    }

    // Model Factory...
    public function scopeModelFactory(Builder $builder)
    {
        return new MemberModelFactory($builder);
    }



    public function getWorkspaces(string $memberID)
    {
        return $this->model->with('workspaces')->where('id', $memberID)->first()->workspaces;
    }

    public function getMembers(?int $paginate = null, ?string $searchTerm = null, array $searchFields = [], ?string $order = null, string $direction = 'asc')
    {
        $builder = $this->buildSearch(
            builder: $this->model::with('workspaces'),
            searchTerm: $searchTerm,
            searchFields: $searchFields
        );

        $builder = $this->buildOrder($builder, $order, $direction);

        return $this->getOrPaginate($builder, $paginate);
    }

    public function findMember(string $email)
    {
        return $this->model->where('email', $email);
    }

    public function canResetPassword(string $email, string $token): bool
    {
        $resetter = DB::table(config('rebase.paths.db.workspace.name').'.password_resets')
            ->where('email', '=', $email)
            ->where('token', '=', $token)
            ->first();

        if (is_null($resetter)) {
            return false;
        }

        $maxTokenTime = Carbon::parse($resetter->created_at)->addHours(1);

        return $maxTokenTime->gte(Carbon::now());
    }
}
