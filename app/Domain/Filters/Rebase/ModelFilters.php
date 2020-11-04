<?php

namespace App\Domain\Filters\Rebase;

use Illuminate\Database\Eloquent\Model;

class ModelFilters
{
    private ?Model $model = null;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
