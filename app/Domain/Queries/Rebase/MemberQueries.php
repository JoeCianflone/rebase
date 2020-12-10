<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use Illuminate\Support\Carbon;
use App\Enums\Rebase\MemberRoles;
use Illuminate\Support\Facades\DB;
use App\Domain\Models\Rebase\Workspace\Member;

class MemberQueries extends ModelQueries
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'member';
    }

    public function getWorkspaces(string $memberID)
    {
        return $this->model->with('workspaces')->where('id', $memberID)->first()->workspaces;
    }

    public function allCustomerMembers(bool $withRoles = false): self
    {
        $this->query = $withRoles ? $this->model::with(['roles']) : $this->model;

        return $this;
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
