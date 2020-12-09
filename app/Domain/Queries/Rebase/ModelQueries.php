<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class ModelQueries
{

    protected $query;

    public function __construct(protected ?Model $model = null,
                                protected string $cacheKey = '',
                                protected int $cacheTime = 300)
    {
    }

    public function get()
    {
        return $this->query->get();
    }

    public function first()
    {
        return $this->query->first();
    }

    public function paginate(int $size)
    {
        return $this->query->paginate($size);
    }

    public function getByID(string|Uuid $id): ?Model
    {
        return $this->cache('getByID' . $id, fn() => $this->model->where('id', '=', $id)->firstOrFail());
    }

    protected function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }
}
