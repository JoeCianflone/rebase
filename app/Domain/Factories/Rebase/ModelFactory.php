<?php

namespace App\Domain\Factories\Rebase;

use Illuminate\Database\Eloquent\Model;

class ModelFactory
{
    private ?Model $model = null;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(array $request): Model
    {
        return $this->model->create($request);
    }

    /**
     * Ways to use the update(...) function
     * ::update([]) -- this uses the $model you've passed into it
     * ::update('foo', '=', 'bar', [])
     * ::update('foo', 'bar', []).
     */
    public function update(...$update): ?Model
    {
        if (count($update) === 1) {
            $this->model->update($update[0]);

            return $this->model;
        }

        if (count($update) === 2) {
            [$model, $data] = $update;
            $model->update($data);

            return $model;
        }

        if (count($update) === 3) {
            [$col, $check, $data] = $update;
            $type = '=';
        } elseif (count($update) === 4) {
            [$col, $type, $check, $data] = $update;
        }

        $this->model->where($col, $type, $check)->update($data);

        return $this->model;
    }

    public function remove(...$remove): void
    {
        if (count($remove) <= 0) {
            $this->model->delete();

            return;
        }
        if (count($remove) === 1) {
            $this->model->destroy(collect($remove[0]));

            return;
        }

        if (count($remove) === 2) {
            [$col, $check] = [$remove];
            $type = '=';
        } elseif (count($remove) === 3) {
            [$col, $type, $check] = [$remove];
        }

        $this->model->where($col, $type, $check)->delete();
    }
}
