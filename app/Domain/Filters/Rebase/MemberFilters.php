<?php

namespace App\Domain\Filters\Rebase;

class MemberFilters extends ModelFilters
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
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
}
