<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use Illuminate\Database\Eloquent\Builder;

class ModelFactory
{

    public function __construct(protected Builder $builder)
    {
    }

    public function create(array $request)
    {
        return $this->builder->create($request);
    }

    public function update(array $update, ?string $whereCol = null, ?string $whereValue = null)
    {
        if (is_null($whereCol)) {
            return $this->builder->update($update);
        }

        return $this->builder->where($whereCol, $whereValue)->update($update);
    }

    public function remove(?array $ids = null, ?string $whereCol = null, ?string $whereValue = null)
    {
        if (is_null($ids) && is_null($whereCol)) {
            return $this->builder->delete();
        }

        if (is_null($whereCol)) {
            return $this->builder->where($whereCol, $whereValue)->delete();
        }

        return $this->builder->destroy(collect($ids));
    }
}
