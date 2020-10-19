<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Rebase;

use App\Domain\Models\Rebase\Workspace\Member;

class EloquentMemberRepository extends EloquentRepository
{
    public function __construct(Member $model)
    {
        $this->model = $model;
        $this->cacheKey = 'member';
    }
}
