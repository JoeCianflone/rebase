<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Helpers\QueryCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class EloquentRepository
{
    protected Model $model;
    protected QueryCache $cache;
    protected string $cacheKey = '';

    protected array $withData = [];

    public function __construct()
    {
        $this->cache = resolve('QueryCache');
        $this->cache->setKey($this->cacheKey);
    }

    /**
     * @return null|Collection<Model>
     */
    public function all(): ?Collection
    {
        return $this->cache
            ->as('all')
            ->from(fn () => $this->model->all())
        ;
    }

    public function getByID(Uuid $id): ?Model
    {
        return $this->cache
            ->as('getByID.'.$id)
            ->from(fn () => $this->model->whereId($id)->first())
        ;
    }

    public function with(array $data): self
    {
        $this->withData = array_merge($this->withData, $data);

        return $this;
    }

    public function purge(): self
    {
        $this->withData = [];

        return $this;
    }

    public function create(array $request): Model
    {
        return $this->model->create(array_merge($request, $this->withData));
    }

    public function refresh(Model $model): Model
    {
        collect($this->withData)->each(function ($item, $key) use ($model) {
            $model->{$key} = $item;
        });

        $model->save();

        return $model;
    }

    /**
     * @param int|\Ramsey\Uuid\Uuid $id
     */
    public function update($id): void
    {
        $this->model->whereId($id)->update($this->withData);
    }

    public function remove(Model $model): void
    {
        $model->delete();
    }
}
