<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Workspace;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->model = $model;
        $this->cacheKey = 'workspace';
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->whereSlug($slug)->count() > 0;
    }

    public function getBySlug(string $slug): Workspace
    {
        return $this->cache('getBySlug', fn () => $this->model->whereSlug($slug)->firstOrFail());
    }

    public function getByDomain(string $domain): Workspace
    {
        return $this->cache('getByDomain', fn () => $this->model->whereDomain($domain)->firstOrFail());
    }

    public function getByAccountID(string $id): Workspace
    {
        return $this->cache('getByAccountID', fn () => $this->model->whereAccountId($id)->firstOrFail());
    }
}
