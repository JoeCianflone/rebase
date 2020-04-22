<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use Ramsey\Uuid\Uuid;
use App\Domain\Models\Account;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Repositories\EloquentRepository;
use App\Domain\Repositories\Traits\EloquentQueries;

class EloquentAccountRepository extends EloquentRepository
{
    use EloquentQueries;

    protected string $cacheKey = 'account';

    public function __construct(Account $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
