<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Listing;

class EloquentListingRepository extends EloquentRepository
{
    protected string $cacheKey = 'listing';

    public function __construct(Listing $model)
    {
        $this->model = $model;
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->whereSlug($slug)->count() > 0;
    }

    public function getBySlug(string $slug): ?Listing
    {
        return $this->cache
            ->as('getBySlug')
            ->from(fn () => $this->model->where('slug', $slug)->firstOrFail())
        ;
    }

    public function getByDomain(string $domain): ?Listing
    {
        return $this->cache
            ->as('getByDomain')
            ->from(fn () => $this->model->where('domain', $domain)->firstOrFail())
        ;
    }
}
