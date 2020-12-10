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

    public function get(?string $order = null): ?Collection
    {

        return $order ? $this->query->orderBy($order)->get() : $this->query->get();
    }

    public function first(): ?Model
    {
        return $this->query->first();
    }

    public function filterBy($q, $fields)
    {
        if ($q) {
            $this->query->where(function ($query) use ($q, $fields): void {
                $count = 0;
                $query->where($fields[$count], 'LIKE', '%' . $q . '%');
                while (++$count < count($fields)) {
                    $query->orWhere($fields[$count], 'LIKE', '%' . $q . '%');
                }
            });
        }

        return $this;
    }

    public function paginate(int $count = 10, ?array $order = null)
    {
        return $order ? $this->query->orderBy($order['col'], $order['direction'])->paginate($count): $this->query->paginate($count);
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

    protected function cache(string $name, Closure $fn)
    {
        return Cache::remember("{$this->cacheKey}__{$name}__", $this->cacheTime, $fn);
    }
}
