<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Enums\Rebase\WorkspaceStatus;
use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceModelFactory extends ModelFactory
{

    public function markAsVerified(): ?Workspace
    {
        $this->builder->update([
            'status' => WorkspaceStatus::VERIFIED(),
            'activation_token' => null,
            'activation_at' => null,
        ]);
    }

    public function archive(string $workspaceID): ?Workspace
    {
        $this->builder->update('id', $workspaceID, ['status' => (string)WorkspaceStatus::ARCHIVED()]);

        return $this->model;
    }
}
