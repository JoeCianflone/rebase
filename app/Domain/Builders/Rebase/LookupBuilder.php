<?php declare(strict_types=1);

namespace App\Domain\Builders\Rebase;

use App\Enums\Rebase\MemberRoles;
use App\Domain\Builders\Rebase\ModelBuilder;

class LookupBuilder extends ModelBuilder
{

    public function byDomain(string $domain)
    {
        $this->where('domain',  $domain);

        return $this;
    }

    public function byWorkspaceID(string $id)
    {
        $this->where('workspace_id', $id);

        return $this;
    }

    public function byCustomerID(string $id)
    {
        $this->where('customer_id', $id);

        return $this;
    }
}
