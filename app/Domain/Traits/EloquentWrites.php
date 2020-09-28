<?php

namespace App\Domain\Traits;

use Illuminate\Database\Eloquent\Model;

trait EloquentWrites
{
    public function create(array $request): Model
    {
        return $this->model->create(array_merge($request, $this->data));
    }

    public function refresh(Model $model): Model
    {
        collect($this->data)->each(function ($item, $key) use ($model) {
            return $model->{$key} = $item;
        });

        $model->save();

        return $model;
    }

    /**
     * @param int|\Ramsey\Uuid\Uuid $id
     */
    public function update($id): void
    {
        $this->model->whereId($id)->update($this->data);
    }

    public function remove(Model $model): void
    {
        $model->delete();
    }

    public function with(array $data): self
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function purge(): self
    {
        $this->data = [];

        return $this;
    }
}
