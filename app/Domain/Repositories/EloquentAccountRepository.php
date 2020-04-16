<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use Ramsey\Uuid\Uuid;
use App\Domain\Models\Account;
use Illuminate\Database\Eloquent\Model;

class EloquentAccountRepository extends EloquentRepository
{
    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function getByID(Uuid $id): Model
    {
        return $this->model->where('id', $id)->firstOrFail();
    }
}
