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

    public function buildSearch(Builder $builder, string $searchTerm = null, array $searchFields = [])
    {
        if ($searchTerm || count($searchFields)) {
            return $builder->where(function ($query) use ($searchTerm, $searchFields): void {
                $count = 0;
                $query->where($searchFields[$count], 'LIKE', '%' . $searchTerm . '%');
                while (++$count < count($searchFields)) {
                    $query->orWhere($searchFields[$count], 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return $builder;
    }

    protected function cache(string $name, Closure $query)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $query);
    }
}
