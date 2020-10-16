<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Customer\Lookup;

class EloquentLookupRepository extends EloquentRepository
{
    public function __construct(Lookup $model)
    {
        $this->model = $model;
        $this->cacheKey = 'lookup';
    }

    public function whereBySlug(string $slug)
    {
        return $this->model->where('slug', '=', $slug)->firstOrFail();
    }

    public function whereByDomain(string $domain)
    {
        return $this->model->where('domain', '=', $domain)->firstOrFail();
    }

    public function whereWorkspaceID(string $id)
    {
        return $this->model->where('workspace_id', '=', $id)->firstOrFail();
    }
}
