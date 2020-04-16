<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Repositories\EloquentRepository;

class EloquentListingRepository extends EloquentRepository
{
    public function __construct(Listing $model)
    {
        $this->model = $model;
    }

    public function slugExists(string $slug): bool
    {
        return $this->model->where('slug', $slug)->count() > 0;
    }

    public function getBySlug(string $slug): ?Model
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function getByDomain(string $domain): ?Model
    {
        return $this->model->where('domain', $domain)->firstOrFail();
    }
}
