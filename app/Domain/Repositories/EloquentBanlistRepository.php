<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Banlist;

class EloquentBanlistRepository extends EloquentRepository
{
    protected string $cacheKey = 'banlist';

    public function __construct(Banlist $model)
    {
        $this->model = $model;
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->whereSlug($slug)->count() > 0;
    }
}
