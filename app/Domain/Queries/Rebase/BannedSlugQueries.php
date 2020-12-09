<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Admin\BannedSlug;

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
