<?php

namespace App\Domain\Factories\Rebase;

use App\Domain\Models\Rebase\Workspace\Member;

class MemberModelFactory extends ModelFactory
{
    public function __construct(Member $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function attachToWorkspace($workspaceID): void
    {
        $this->model->workspaces()->attach($workspaceID);
    }
}
