<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Validate;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotAnOwnerException;
use App\Exceptions\InvalidActivationToken;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;
use App\Http\Requests\Rebase\ValidateWorkspaceRequest;

class ProcessValidateWorkspace extends Controller
{
    public function __invoke(ValidateWorkspaceRequest $request, string $token)
    {
        try {
            $matchingWorkspace = WorkspaceRepository::matchSlugAndToken($token, $request->get('slug'));
            if (!WorkspaceRepository::filter($matchingWorkspace)->activationIsOnTime(Carbon::now())) {
                throw new InvalidActivationToken('Your token has expired');
            }

            $owner = WorkspaceRepository::query($matchingWorkspace)->getOwnerWithEmail($request->get('email'));

            MemberRepository::factory($owner)->update([
                'password' => Hash::make($request->get('password')),
                'email_token' => null,
            ]);
            WorkspaceRepository::factory($matchingWorkspace)->markAsVerified();
        } catch (InvalidActivationToken | NotAnOwnerException $e) {
            return redirect()->route('validate.workspace.complete');
            dd($e);
        }

        return redirect()->route('validate.workspace.complete');
    }
}
