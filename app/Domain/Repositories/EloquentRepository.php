<?php
namespace App\Domain\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model;
     */
    protected $model;

    protected $withData = [];

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getAll(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $request
     * @param array $updates
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $request): Model
    {
        return $this->model->create(array_merge($request, $this->withData));
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $updates
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function refresh(Model $model): Model
    {
        if (count($this->withData) > 0) {
            foreach ($this->withData as $key => $value) {
                $model[$key] = $value;
            }
        }

        $model->save();

        return $model;
    }

    /**
     * @param int|Ramsey\Uuid\Uuid $id
     * @param array $update
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

    /**
     * @param int|Ramsey\Uuid\Uuid $id
     * @return void
     */
    public function remove($id): void
    {
        $this->model->destroy($id);
    }
}
