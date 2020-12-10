<?php declare(strict_types=1);

namespace App\Domain\Filters\Rebase;

class MemberFilters extends ModelFilters
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function hasLoggedIn()
    {
        return (bool)$this->model->password === null;
    }

}
