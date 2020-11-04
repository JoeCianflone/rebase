<?php

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Workspace\Member;

class MemberFilters extends ModelFilters
{
    private Member $model;

    public function __construct(Member $model)
    {
        $this->model = $model;
    }

    public function hasLoggedIn()
    {
        return (bool) $this->model->password === null;
    }
}
