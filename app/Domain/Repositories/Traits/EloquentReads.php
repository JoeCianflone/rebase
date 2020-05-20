<?php

namespace App\Domain\Repositories\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait EloquentReads
{
    public function all(): ?Collection
    {
        return $this->cache
            ->as('all')
            ->execute(fn () => $this->model->all())
        ;
    }

    public function getByID(Uuid $id): ?Model
    {
        return $this->cache
            ->as('getByID'.$id)
            ->execute(fn () => $this->model->whereId($id)->firstOrFail())
        ;
    }
}
