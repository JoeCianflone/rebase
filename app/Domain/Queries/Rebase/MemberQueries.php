<?php

namespace App\Domain\Queries\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Domain\Models\Rebase\Workspace\Member;

class MemberQueries extends ModelQueries
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'member';
    }

    public function getOwners()
    {
        return $this->model->whereJsonContains('roles', ['type' => MemberRoles::OWNER()])->get();
    }

    public function getWorkspaces(string $memberID)
    {
        return $this->model->with('workspaces')->where('id', $memberID)->first()->workspaces;
    }

    public function findMember(string $email)
    {
        return $this->model->where('email', $email);
    }
}
