<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Validate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UnknownOwnerException;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;
use App\Http\Requests\Rebase\ValidateWorkspaceRequest;

class ProcessValidateWorkspace extends Controller
{
    public function __invoke(ValidateWorkspaceRequest $request, string $token)
    {
        try {
            $matchingWorkspace = WorkspaceRepository::query()->matchSlugAndToken($token, $request->get('slug'));
            $owner = WorkspaceRepository::query($matchingWorkspace)->getOwnerWithEmail($request->get('email'));

            MemberRepository::factory($owner)->update([
                'password' => Hash::make($request->get('password')),
                'email_token' => null,
            ]);

            WorkspaceRepository::factory($matchingWorkspace)->markAsVerified();
        } catch (UnknownOwnerException $e) {
            return redirect()->route('login')->withError('You are not allowed to do that');
        }

        return redirect()->route('login')->withSuccess('All set! You can now log in');
    }
}
