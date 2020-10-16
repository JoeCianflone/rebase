<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Workspace\Workspace;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->model = $model;
        $this->cacheKey = 'workspace';
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', '=', $slug)->count() > 0;
    }

    public function whereBySlug(string $slug): Workspace
    {
        return $this->cache('whereBySlug', fn () => $this->model->where('slug', '=', $slug)->firstOrFail());
    }

    public function whereByDomain(string $domain): Workspace
    {
        return $this->cache('whereByDomain', fn () => $this->model->where('domain', '=', $domain)->firstOrFail());
    }

    public function whereByCustomerID(string $id): Workspace
    {
        return $this->cache('whereByCustomerID', fn () => $this->model->where('customer_id', '=', $id)->firstOrFail());
    }
}
