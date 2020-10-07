<?php

namespace App\Services\Registration;

use App\Domain\Models\Member;

class AddFirstMemberToWorkspace
{
    public function __invoke($payload)
    {

        $member = Member::create([
            'name' => $payload->get('name'),
            'email' => $payload->get('email'),
        ]);

        $member->roles()->attach(1, ['workspace_id' => $payload->get('customer')->workspaces()->first()->id]);

        return $payload;
    }
}
