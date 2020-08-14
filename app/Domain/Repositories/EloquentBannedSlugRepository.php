<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Helpers\QueryCache;
use App\Domain\Models\BannedSlug;

class EloquentBannedSlugRepository extends EloquentRepository
{
    public function __construct(BannedSlug $model)
    {
        $this->cache = new QueryCache('bannedslug');
        $this->model = $model;
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', $slug)->exists();
    }

    public function doesNotHaveSlug(string $slug): bool
    {
        return !$this->model->where('slug', $slug)->exists();
    }
}
