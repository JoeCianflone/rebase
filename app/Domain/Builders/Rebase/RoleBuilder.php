<?php declare(strict_types=1);

namespace App\Domain\Builders\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Domain\Builders\Rebase\ModelBuilder;

class RoleBuilder extends ModelBuilder
{
    public function accountOwner()
    {
        $this->where('type', MemberRoles::ACCOUNT_OWNER());

        return $this;
    }
}
