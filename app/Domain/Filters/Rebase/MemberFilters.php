<?php

namespace App\Domain\Filters\Rebase;

class MemberFilters extends ModelFilters
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function hasLoggedIn()
    {
        return (bool) $this->model->password === null;
    }

    public function mapCurrentWorkspaceRole(string $workspaceID)
    {
        return $this->model->each(function ($item) use ($workspaceID): void {
            $item->currentWorkspaceRole = $item->roles[$workspaceID];
        });
    }

    public function appendRole(string $workspaceID)
    {
        $this->modal->currentRole = $this->roles[$workspaceID];

        return $this->modal;
    }
}
