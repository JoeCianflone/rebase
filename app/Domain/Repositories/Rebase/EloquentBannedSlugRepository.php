<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Queries\Rebase\BannedSlugQueries;
use App\Domain\Models\Rebase\Admin\BannedSlug;
use App\Domain\Queries\Rebase\ModelQueries;
use JetBrains\PhpStorm\Pure;

class EloquentBannedSlugRepository extends EloquentRepository
{
    public function __construct(BannedSlug $model)
    {
        $this->model = $model;
    }

    public function query($model = null): ModelQueries
    {
        return new BannedSlugQueries($model ?? $this->model);
    }
}
