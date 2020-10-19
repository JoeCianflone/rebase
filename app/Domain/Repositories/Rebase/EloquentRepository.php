<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class EloquentRepository
{
    protected array $data = [];

    protected Model $model;

    protected ?Model $row = null;

    protected int $cacheTime = 300;

    protected string $cacheKey = '';

    /**
     * Generic all.
     */
    public function whereAll(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * Genric read and get by ID.
     *
     * @param string|uuid $id
     */
    public function whereID($id): ?Model
    {
        return $this->cache('whereID'.$id, fn () => $this->model->where('id', '=', $id)->firstOrFail());
    }

    public function for(Model $model): self
    {
        $this->row = $model;

        return $this;
    }

    public function create(array $request): Model
    {
        return $this->model->create($request);
    }

    public function update(array $data): Model
    {
        $this->row->update($data);

        return $this->clearRowModel();
    }

    public function updateWhere(array $ids, array $data): void
    {
        collect($ids)->each(function ($key, $value) use ($data): void {
            $this->model->where($key, '=', $value)->update($data);
        });

        $this->clearRowModel();
    }

    public function remove(): Model
    {
        $this->row->delete();

        return $this->clearRowModel();
    }

    public function removeWhere(array $ids): void
    {
        collect($ids)->each(function ($key, $value): void {
            $this->model->where($key, '=', $value)->delete();
        });

        $this->clearRowModel();
    }

    public function attach(string $method, $id, array $extra = []): void
    {
        $this->row->{$method}()->attach($id, $extra);
        $this->clearRowModel();
    }

    protected function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }

    protected function clearRowModel(): Model
    {
        $temp = $this->row;
        $this->row = null;

        return $temp;
    }
}
