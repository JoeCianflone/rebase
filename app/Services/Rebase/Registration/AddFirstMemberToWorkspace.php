<?php

declare(strict_types=1);

namespace App\Services\Rebase\Registration;

use Illuminate\Support\Carbon;
use App\Enums\Rebase\MemberRoles;
use App\Domain\Facades\Rebase\MemberRepository;

class AddFirstMemberToWorkspace
{
    public function __invoke($payload)
    {
        $member = MemberRepository::create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        MemberRepository::for($member)->attach('workspaces', $payload->get('workspace')->id, ['role' => MemberRoles::OWNER()]);

        $payload->put('member', $member);

        return $payload;
    }
}
