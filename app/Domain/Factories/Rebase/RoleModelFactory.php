<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use Exception;
use App\Enums\Rebase\MemberRoles;
use App\Domain\Models\Rebase\Workspace\Role;

class RoleModelFactory extends ModelFactory
{
    public function removeMemberRole(string $role, string $memberID, ?string $workspaceID = null): void
    {
        $this->builder->where('type', $role)
            ->where('member_id', $memberID)
            ->where('workspace_id', $workspaceID)
            ->remove();
    }

    public function addAccountOwner(string $memberID): void
    {
        $this->builder->updateOrCreate(
            ['type' => MemberRoles::ACCOUNT_OWNER()],
            ['member_id' => $memberID]
        );
    }

    public function addAccountAdmin(string $memberID): void
    {
        $currentRoles = $this->builder->where('member_id', $memberID)->get();

        if ($currentRoles->contains('type', MemberRoles::ACCOUNT_OWNER())) {
            throw new Exception('Cannot downgrade account owner without first setting a new account owner');
        }

        $this->remove($currentRoles->toArray());
        $this->builder->create(['type' => MemberRoles::ACCOUNT_ADMIN(), 'member_id' => $memberID]);
    }

    public function addWorkspaceRole(string $role, string $workspaceID, string $memberID): void
    {
        $this->builder->updateOrCreate(
            ['member_id' => $memberID, 'workspace_id' => $workspaceID],
            ['type' => $role]
        );
    }
}
