<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Queries\Rebase\LookupQueries;
use App\Domain\Models\Rebase\Admin\Lookup;

class EloquentLookupRepository extends EloquentRepository
{
    public function __construct(Lookup $model)
    {
        $this->model = $model;
    }

    public function query($model = null)
    {
        return new LookupQueries($model ?? $this->model);
    }
}
