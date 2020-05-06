<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Banlist;
use App\Domain\Repositories\Traits\EloquentQueries;

class EloquentBanlistRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'banlist';

    public function __construct(Banlist $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
