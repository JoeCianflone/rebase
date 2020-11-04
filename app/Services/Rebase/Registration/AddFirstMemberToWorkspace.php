<?php

declare(strict_types=1);

namespace App\Services\Rebase\Registration;

use Illuminate\Support\Carbon;
use App\Domain\Facades\Rebase\MemberRepository;

class AddFirstMemberToWorkspace
{
    public function __invoke($payload)
    {
        $member = MemberRepository::factory()->create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        MemberRepository::factory($member)->attachAsOwner($payload->get('workspace')->id);

        $payload->put('member', $member);

        return $payload;
    }
}
