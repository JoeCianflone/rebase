<?php
namespace App\Domain\Collections\Rebase;

use App\Enums\Rebase\MemberRoles;
use Illuminate\Database\Eloquent\Collection;

class RoleCollection extends Collection
{
    public function mapToWorkspace()
    {
        return $this->mapWithKeys(function ($item, $key) {

            if ($item['workspace_id']) {
                return [$item['workspace_id'] => $item['type']];
            }

            return [$item['type'] => true];
        });
    }

    public function hasAccountRole()
    {
        return $this->contains(function($role) {
            return $role->type === MemberRoles::ACCOUNT_ADMIN() || MemberRoles::ACCOUNT_OWNER();
        });
    }

    public function isAccountOwner()
    {
        return $this->contains('type', MemberRoles::ACCOUNT_OWNER());
    }
}
