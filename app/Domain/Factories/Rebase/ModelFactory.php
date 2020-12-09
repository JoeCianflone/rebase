<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use Illuminate\Database\Eloquent\Model;

class ModelFactory
{

    public function __construct(protected ?Model $model = null)
    {
    }

    public function create(array $request): Model
    {
        return $this->model->create($request);
    }

    public function update(...$update): ?Model
    {
        match (count($update)) {
            1 => $this->model->update($update[0]),
//            2 => $update[0]->update($update[1]),
            3 => $this->model->where($update[0], '=', $update[1])->update($update[2]),
            4 => $this->model->where($update[0], $update[1], $update[2])->update($update[3]),
        };

        return $this->model;
    }

    public function remove(...$remove): void
    {
        match (count($remove)) {
            0 => $this->model->delete(),
            1 => $this->model->destroy(collect($remove[0])),
            2 => $this->model->where($remove[0], $remove[1])->delete(),
            3 => $this->model->where($remove[0], $remove[1], $remove[3])->delete(),
        };
    }
}
