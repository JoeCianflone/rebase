<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Filters\Rebase\ModelFilters;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\Factories\Rebase\ModelFactory;

abstract class EloquentRepository
{
    protected Model $model;

    protected int $cacheTime = 300;

    protected string $cacheKey = '';

    public function factory($model = null)
    {
        return new ModelFactory($model ?? $this->model);
    }

    public function filter($model)
    {
        return new ModelFilters($model);
    }

    public function query($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    public function getByID($id): ?Model
    {
        return $this->cache('getByID'.$id, fn () => $this->model->where('id', '=', $id)->firstOrFail());
    }

    protected function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }
}
