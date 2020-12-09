<?php declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Factories\Rebase\ModelFactory;
use App\Domain\Filters\Rebase\MemberFilters;
use App\Domain\Filters\Rebase\ModelFilters;
use App\Domain\Queries\Rebase\MemberQueries;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Factories\Rebase\MemberModelFactory;
use App\Domain\Queries\Rebase\ModelQueries;

class EloquentMemberRepository extends EloquentRepository
{

    public function __construct(Member $model)
    {
        $this->model = $model;
    }

    public function filter($model): ModelFilters
    {
        return new MemberFilters($model);
    }

    public function factory($model = null): ModelFactory
    {
        return new MemberModelFactory($model ?? $this->model);
    }

    public function query($model = null): ModelQueries
    {
        return new MemberQueries($model ?? $this->model);
    }
}
