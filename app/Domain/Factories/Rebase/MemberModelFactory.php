<?php

namespace App\Domain\Factories\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Domain\Models\Rebase\Workspace\Member;

class MemberModelFactory extends ModelFactory
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function attachToWorkspaceAs($workspaceID, $role): void
    {
        $this->model->workspaces()->attach($workspaceID, ['role' => $role]);
    }

    public function attachAsOwner($workspaceID): void
    {
        $this->attachToWorkspaceAs($workspaceID, MemberRoles::OWNER());
    }

    public function attachAsMember($workspaceID): void
    {
        $this->attachToWorkspaceAs($workspaceID, MemberRoles::MEMBER());
    }
}
