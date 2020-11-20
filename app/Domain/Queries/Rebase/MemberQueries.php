<?php

namespace App\Domain\Queries\Rebase;

use App\Domain\Models\Rebase\Workspace\Workspace;

class MemberQueries extends ModelQueries
{
    public function __construct(Workspace $model)
    {
        parent::__construct($model);
        $this->cacheKey = 'member';
    }
}
