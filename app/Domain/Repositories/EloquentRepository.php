<?php
namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model;
     */
    protected $model;

    /**
     * @param array $request
     * @param array $updates
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $request, array $updates = []): Model
    {
        return $this->model->create(array_merge($request, $updates));
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $updates
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function refresh(Model $model, array $updates = null): Model
    {
        if (is_null($updates)) {
            $model->save();
        } else {
            foreach ($updates as $key => $value) {
                $model[$key] = $value;
            }
            $model->save();
        }

        return $model;
    }

    /**
     * @param int|Ramsey\Uuid\Uuid $id
     * @param array $update
     * @return void
     */
    protected function update($id, array $update): void
    {
        $this->model->where('id', $id)->update($update);
    }

    /**
     * @param int|Ramsey\Uuid\Uuid $id
     * @return void
     */
    protected function delete($id): void
    {
        $this->model->remove($id);
    }


}
