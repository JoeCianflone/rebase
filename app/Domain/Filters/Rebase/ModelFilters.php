<?php

namespace App\Domain\Filters\Rebase;

class ModelFilters
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getPaginatorLinks()
    {
        return $this->model->toArray()['links'];
    }
}
