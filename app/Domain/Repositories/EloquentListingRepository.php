<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Listing;
use App\Domain\Repositories\Traits\EloquentQueries;
use Illuminate\Database\Eloquent\Model;

class EloquentListingRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'user';

    public function __construct(Listing $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function slugExists(string $slug): bool
    {
        return $this->model->where('slug', $slug)->count() > 0;
    }

    public function getBySlug(string $slug): ?Model
    {
        return $this->cache
            ->as('getBySlug')
            ->from(fn () => $this->model->where('slug', $slug)->firstOrFail())
        ;
    }

    public function getByDomain(string $domain): ?Model
    {
        return $this->cache
            ->as('getByDomain')
            ->from(fn () => $this->model->where('domain', $domain)->firstOrFail())
        ;
    }
}
