<?php

declare(strict_types=1);

namespace App\Services\Registration;

use App\Enums\MemberRoles;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Domain\Facades\MemberRepository;

class AddFirstMemberToWorkspace
{
    public function __invoke($payload)
    {
        $member = MemberRepository::create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
            'email_token' => Hash::make($payload->get('email')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        MemberRepository::for($member)->attach('workspaces', $payload->get('workspace')->id, ['role' => MemberRoles::OWNER()]);

        return $payload;
    }
}
