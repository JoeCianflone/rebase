<?php declare(strict_types=1);

namespace App\Domain\Filters\Rebase;

use Illuminate\Support\Collection;

class ModelFilters
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getPaginatorLinks(): array
    {
        return $this->model->toArray()['links'];
    }

    public function getPaginatorItems(): array
    {
        return $this->model->toArray()['data'];
    }

    public function matches(array $items): ?Collection
    {
        collect($items)->each(function ($item, $key): void {
            $this->model = $this->model->where($key, $item);
        });

        return $this->model;
    }
}
