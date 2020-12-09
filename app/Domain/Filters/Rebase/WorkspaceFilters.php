<?php declare(strict_types=1);

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceFilters extends ModelFilters
{
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
    }

    public function activationIsOnTime(string $time): bool
    {
        return $this->model->activation_at->diffInHours($time) <= env('ACTIVATION_HOURS');
    }
}
