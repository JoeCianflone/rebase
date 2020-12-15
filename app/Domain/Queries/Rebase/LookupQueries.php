<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Admin\Lookup;

class LookupQueries extends ModelQueries
{
    public function __construct(Lookup $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'lookup';
    }

    public function getFirstBySlug(string $slug)
    {
        return $this->cache(
            name: 'getBySlug',
            query: fn() => $this->model->where('slug', '=', $slug)->first()
        );
    }

    public function getFirstByDomain(string $domain)
    {
        return $this->cache(
            name: 'getByDomain',
            query: fn() => $this->model->where('domain', '=', $domain)->first()
        );
    }

    public function getFirstByWorkspaceID(string $id)
    {
        return $this->cache(
            name: 'getByWorkspaceID',
            query: fn() => $this->model->where('workspace_id', '=', $id)->first(),
        );
    }

    public function getFirstByCustomerID(string $id)
    {
        return $this->cache(
            name: 'getByCustomerID',
            query: fn() => $this->model->where('customer_id', '=', $id)->first(),
        );
    }
}
