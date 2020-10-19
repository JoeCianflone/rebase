<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Models\Rebase\Customer\BannedSlug;

class EloquentBannedSlugRepository extends EloquentRepository
{
    public function __construct(BannedSlug $model)
    {
        $this->model = $model;
        $this->cacheKey = 'banned-slugs';
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
