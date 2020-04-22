<?php

namespace App\Domain\Repositories\Traits;

use Ramsey\Uuid\Uuid;

trait EloquentQueries
{
    public function all(): ?Collection
    {
        return $this->cache
                    ->as('all')
                    ->from(fn () => $this->modal->all());
    }

    public function getByID(Uuid $id): ?Model
    {
        return $this->cache
                    ->as('getByID.'.$id)
                    ->from(fn () => $this->model->where('id', $id)->firstOrFail());
    }
}
