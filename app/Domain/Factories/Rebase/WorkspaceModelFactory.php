<?php

namespace App\Domain\Factories\Rebase;

use App\Enums\Rebase\WorkspaceStatus;
use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceModelFactory extends ModelFactory
{
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function markAsVerified()
    {
        $this->update($this->model, [
            'status' => WorkspaceStatus::VERIFIED(),
            'activation_token' => null,
            'activation_at' => null,
        ]);

        return $this->model;
    }
}
