<?php declare(strict_types=1);

namespace App\Domain\Builders\Rebase;

use Closure;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ModelBuilder extends Builder
{
    protected Builder $builder;

    public function bySlug(string $slug): ModelBuilder
    {
        $this->where('slug', $slug);

        return $this;
    }

    public function searchable(string $searchTerm = null, array $searchFields = []): ModelBuilder
    {
        if ($searchTerm || count($searchFields)) {
            return $this->where(function ($query) use ($searchTerm, $searchFields): void {
                $count = 0;
                $query->where($searchFields[$count], 'LIKE', '%' . $searchTerm . '%');
                while (++$count < count($searchFields)) {
                    $query->orWhere($searchFields[$count], 'LIKE', '%' . $searchTerm . '%');
                }
            });
        }

        return $this;
    }

    public function orderable(?string $column = null, string $direction = 'asc'): ModelBuilder
    {
        if ($column) {
            $this->orderBy($column, $direction);
        }

        return $this;
    }
}
