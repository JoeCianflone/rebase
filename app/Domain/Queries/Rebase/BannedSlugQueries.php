<?php

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Customer\BannedSlug;

class BannedSlugQueries extends ModelQueries
{
    public function __construct(BannedSlug $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'bannedSlug';
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', $slug)->exists();
    }
}
