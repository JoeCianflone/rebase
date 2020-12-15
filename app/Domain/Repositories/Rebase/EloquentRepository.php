<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use JetBrains\PhpStorm\Pure;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Filters\Rebase\ModelFilters;
use App\Domain\Queries\Rebase\ModelQueries;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\Factories\Rebase\ModelFactory;

abstract class EloquentRepository
{
    protected Model $model;

    public function factory(Model $model = null): ModelFactory
    {
        return new ModelFactory($model ?? $this->model);
    }

    public function filter(Collection|Model $model): ModelFilters
    {
        return new ModelFilters($model);
    }

    public function query(Model $model = null): ModelQueries
    {
        return new ModelQueries($model ?? $this->model);
    }
}
