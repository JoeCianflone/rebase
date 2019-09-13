<?php
namespace App\Domain\Repositories;

use App\Domain\Models\User;

class EloquentUserRepository extends EloquentRepository{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

}
