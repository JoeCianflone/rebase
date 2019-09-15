<?php
namespace App\Domain\Repositories;

use App\Domain\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class EloquentLandlordRepository extends EloquentRepository
{

    public function __construct(Tenant $model)
    {
        $this->model = $model;
    }

    public function getBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

}
