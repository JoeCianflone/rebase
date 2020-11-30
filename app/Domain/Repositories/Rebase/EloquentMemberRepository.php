<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Filters\Rebase\MemberFilters;
use App\Domain\Queries\Rebase\MemberQueries;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Factories\Rebase\MemberModelFactory;

class EloquentMemberRepository extends EloquentRepository
{
    public function __construct(Member $model)
    {
        $this->model = $model;
        $this->cacheKey = 'member';
    }

    public function filter($model)
    {
        return new MemberFilters($model);
    }

    public function factory($model = null)
    {
        return new MemberModelFactory($model ?? $this->model);
    }

    public function query($model = null)
    {
        return new MemberQueries($model ?? $this->model);
    }
}
