<?php
namespace App\Domain\Repositories;

use App\Domain\Models\Blacklist;
use App\Domain\Repositories\EloquentRepository;

class EloquentBlacklistRepository extends EloquentRepository
{

    public function __construct(Blacklist $model)
    {
        $this->model = $model;
    }

    public function hasSlug(string $slug): bool
    {
        return $this->model->where('slug', $slug)->count() > 0;
    }

    public function getBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->get();
    }
}
