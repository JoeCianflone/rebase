<?php

namespace App\Domain\Queries\Rebase;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ModelQueries
{
    protected int $cacheTime;
    protected string $cacheKey;
    protected ?Model $model = null;
    protected $query;

    public function __construct(Model $model, string $cacheKey = '', int $cacheTime = 300)
    {
        $this->model = $model;
        $this->cacheTime = $cacheTime;
        $this->cacheKey = $cacheKey;
    }

    public function get()
    {
        return $this->query->get();
    }

    public function paginate(int $size)
    {
        return $this->query->paginate($size);
    }

    public function getAll(): ?Collection
    {
        return $this->model->get();
    }

    public function getByID($id): ?Model
    {
        return $this->cache('getByID'.$id, fn () => $this->model->where('id', '=', $id)->firstOrFail());
    }

    protected function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }
}
