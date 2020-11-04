<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Models\Rebase\Customer\Lookup;

class EloquentLookupRepository extends EloquentRepository
{
    public function __construct(Lookup $model)
    {
        $this->model = $model;
        $this->cacheKey = 'lookup';
    }

    public function getBySlug(string $slug)
    {
        return $this->model->where('slug', '=', $slug)->firstOrFail();
    }

    public function getByDomain(string $domain)
    {
        return $this->model->where('domain', '=', $domain)->firstOrFail();
    }

    public function getByWorkspaceID(string $id)
    {
        return $this->model->where('workspace_id', '=', $id)->firstOrFail();
    }
}
