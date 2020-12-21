<?php declare(strict_types=1);

namespace App\Services\Rebase\Registration;

use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Models\Rebase\Workspace\Role;
use Illuminate\Support\Carbon;
use App\Enums\Rebase\MemberRoles;

class AddFirstMemberToWorkspace
{
    public function __invoke($payload)
    {
        $member = Member::modelFactory()->create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::modelFactory()->addAccountOwner($member->id);

        $payload->put('member', $member);

        return $payload;
    }
}
