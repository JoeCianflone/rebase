<?php

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Customer\Lookup;

class LookupQueries extends ModelQueries
{
    public function __construct(Lookup $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'lookup';
    }

    public function getBySlug(string $slug)
    {
        return $this->model->where('slug', '=', $slug);
    }

    public function getByDomain(string $domain)
    {
        return $this->model->where('domain', '=', $domain);
    }

    public function getByWorkspaceID(string $id)
    {
        return $this->model->where('workspace_id', '=', $id);
    }

    public function getByCustomerID(string $id)
    {
        return $this->model->where('customer_id', '=', $id);
    }
}
