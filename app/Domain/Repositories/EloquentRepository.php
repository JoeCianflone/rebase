<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    protected Model $model;

    protected array $withData = [];

    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    public function generateUUID(): string
    {
        return Str::uuid()->toString();
    }

    public function make(array $request): Model
    {
        collect($this->model)->map(function ($key, $value) {
            $this->model->{$key} = $value;
        });

        return $this->model;
    }

    public function create(array $request): Model
    {
        return $this->model->create(array_merge($request, $this->withData));
    }

    public function refresh(Model $model): Model
    {
        if (count($this->withData) > 0) {
            foreach ($this->withData as $key => $value) {
                $model->{$key} = $value;
            }
        }

        $model->save();

        return $model;
    }

    /**
     * @param int|\Ramsey\Uuid\Uuid $id
     * @return void
     */
    public function update($id): void
    {
        $this->model->where('id', $id)->update($this->withData);
    }

    /**
     * @param array $data
     * @return self
     */
    public function with(array $data): self
    {
        $this->withData = array_merge($this->withData, $data);

        return $this;
    }

    /**
     * @return self
     */
    public function purge(): self
    {
        $this->withData = [];

        return $this;
    }

    public function remove(Model $model): void
    {
        $model->delete();
    }
}
