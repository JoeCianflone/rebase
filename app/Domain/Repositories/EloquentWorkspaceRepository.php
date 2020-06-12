<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Helpers\QueryCache;
use App\Domain\Models\Workspace;

class EloquentWorkspaceRepository extends EloquentRepository
{
    public function __construct(Workspace $model)
    {
        $this->cache = new QueryCache('workspace');
        $this->model = $model;
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->whereSlug($slug)->count() > 0;
    }

    public function getBySlug(string $slug): Workspace
    {
        return $this->cache
            ->as('getBySlug')
            ->execute(fn () => $this->model->whereSlug($slug)->firstOrFail())
        ;
    }

    public function getByDomain(string $domain): Workspace
    {
        return $this->cache
            ->as('getByDomain')
            ->execute(fn () => $this->model->whereDomain($domain)->firstOrFail())
        ;
    }

    public function getByAccountId(string $id): Workspace
    {
        return $this->cache
            ->as('getByAccountId-'.$id)
            ->execute(fn () => $this->model->whereAccountId($id)->firstOrFail())
        ;
    }
}
