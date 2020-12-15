<?php declare(strict_types=1);

namespace App\Domain\Queries\Rebase;

use Closure;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ModelQueries
{
    protected $query;

    public function __construct(protected ?Model $model = null,
                                protected string $cacheKey = '',
                                protected int $cacheTime = 300) { }

    public function getOrPaginate(Builder $builder, ?int $pagination = null)
    {
        return is_null($pagination) ? $builder->get() : $builder->paginate($pagination);
    }

    public function buildOrder(Builder $builder, ?string $order = null, string $direction = 'asc')
    {
        return is_null($order) ? $builder : $builder->orderBy($order, $direction);
    }

    public function buildSearch(Builder $builder, string $term = null, array $searchFields = [])
    {
        if ($term || count($searchFields)) {
            return $builder->where(function ($query) use ($term, $searchFields): void {
                $count = 0;
                $query->where($searchFields[$count], 'LIKE', '%' . $term . '%');
                while (++$count < count($searchFields)) {
                    $query->orWhere($searchFields[$count], 'LIKE', '%' . $term . '%');
                }
            });
        }

        return $builder;
    }

    public function findByID(string|Uuid $id): self
    {
        $this->query = $this->model->where('id', $id);

        return $this;
    }

    public function getByID(string|Uuid $id): ?Model
    {
        return $this->cache('getByID' . $id, fn() => $this->model->where('id', '=', $id)->firstOrFail());
    }

    protected function cache(string $name, Closure $query)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $query);
    }
}
