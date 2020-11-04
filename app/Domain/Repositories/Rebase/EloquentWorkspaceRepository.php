<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Exceptions\InvalidActivationToken;
use App\Domain\Filters\Rebase\WorkspaceFilters;
use App\Domain\Models\Rebase\Workspace\Workspace;
use App\Domain\Factories\Rebase\WorkspaceModelFactory;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->model = $model;
        $this->cacheKey = 'workspace';
    }

    public function factory($model = null)
    {
        return new WorkspaceModelFactory($model ?? $this->model);
    }

    public function filter($model)
    {
        return new WorkspaceFilters($model);
    }

    public function getOwnerWithEmail(string $email)
    {
        return $found = $this->model->members()
            ->wherePivot('role', MemberRoles::OWNER())
            ->where('email', $email)
            ->first();
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', '=', $slug)->count() > 0;
    }

    public function getBySlug(string $slug): Workspace
    {
        return $this->cache('getBySlug', fn () => $this->model->where('slug', '=', $slug)->firstOrFail());
    }

    public function getByDomain(string $domain): Workspace
    {
        return $this->cache('getByDomain', fn () => $this->model->where('domain', '=', $domain)->firstOrFail());
    }

    public function matchSlugAndToken(string $token, string $slug)
    {
        return $this->model
            ->where('activation_token', $token)
            ->where('slug', $slug)
            ->firstOr(function (): void {
                throw new InvalidActivationToken('Unable to match a token to slug');
            });
    }
}
