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
        $member = MemberRepository::factory()->create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
            'roles' => [
                [
                    'workspace_id' => $payload->get('workspace')->id,
                    'type' => MemberRoles::OWNER(),
                ],
            ],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        MemberRepository::factory($member)->attachToWorkspace($payload->get('workspace')->id);

        $payload->put('member', $member);

        return $payload;
    }
}
