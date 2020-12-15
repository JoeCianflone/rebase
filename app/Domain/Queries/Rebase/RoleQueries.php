<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Domain\Models\Rebase\Workspace\Role;

class RoleQueries extends ModelQueries
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'role';
    }

    public function getFirstAccountOwner()
    {
        return $this->model::with('members')
                    ->where('type', MemberRoles::ACCOUNT_OWNER())
                    ->first()
                    ->members
                    ->first();
    }

    public function getMemberRoles(string $memberID)
    {
        return $this->model->where('member_id', $memberID)->get();
    }


    public function allRolesForMember(string $memberID)
    {
        return $this->model->where('member_id', $memberID)->get();
    }

    public function isAccountOwner(string $memberID): bool
    {
        return $this->model->where('member_id', $memberID)->where('type', MemberRoles::ACCOUNT_OWNER())->exists();
    }

    public function findAccountOwner(): self
    {
        $this->query = $this->model->where('type', MemberRoles::ACCOUNT_OWNER());

        return $this;
    }

    public function isAccountAdmin(string $memberID): bool
    {
        return $this->model->where('member_id', $memberID)->where('type', MemberRoles::ACCOUNT_ADMIN())->exists();
    }

    public function isWorkspaceAdminOrUp(string $memberID): bool
    {
        return $this->model
            ->where('member_id', $memberID)
            ->whereIn('type', [MemberRoles::WORKSPACE_ADMIN(), MemberRoles::WORKSPACE_OWNER(), MemberRoles::ACCOUNT_ADMIN(), MemberRoles::ACCOUNT_OWNER()])
            ->exists();
    }


}
