<?php

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceFilters extends ModelFilters
{
    private Workspace $model;

    public function __construct(Workspace $model)
    {
        $this->model = $model;
    }

    public function activationIsOnTime($time)
    {
        return $this->model->activation_at->diffInHours($time) <= env('ACTIVATION_HOURS');
    }
}
