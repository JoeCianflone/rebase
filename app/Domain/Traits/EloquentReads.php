<?php

namespace App\Domain\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait EloquentReads
{
    public function all(): ?Collection
    {
        return $this->model->all();
    }

    public function getByID(Uuid $id): ?Model
    {
        return $this->cache('getByID'.$id, fn () => $this->model->whereId($id)->firstOrFail());
    }
}
