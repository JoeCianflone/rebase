<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Helpers\QueryCache;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Repositories\Traits\EloquentReads;
use App\Domain\Repositories\Traits\EloquentWrites;

class EloquentRepository
{
    use EloquentWrites;
    use EloquentReads;

    protected array $data = [];

    protected Model $model;

    protected QueryCache $cache;
}
