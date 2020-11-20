<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Filters\Rebase\ModelFilters;
use App\Domain\Queries\Rebase\ModelQueries;
use App\Domain\Factories\Rebase\ModelFactory;

abstract class EloquentRepository
{
    protected Model $model;

    public function factory($model = null)
    {
        return new ModelFactory($model ?? $this->model);
    }

    public function filter($model)
    {
        return new ModelFilters($model);
    }

    public function query($model = null)
    {
        return new ModelQueries($model ?? $this->model);
    }
}
