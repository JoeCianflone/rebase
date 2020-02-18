<?php
namespace App\Domain\Repositories;

use App\Domain\Models\Account;

class EloquentAccountRepository extends EloquentRepository
{

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

}
