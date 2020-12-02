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

    public function matches(array $items)
    {
        collect($items)->each(function ($item, $key): void {
            $this->model = $this->model->where($key, $item);
        });

        return $this->model;
    }
}
