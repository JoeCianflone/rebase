<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Validate;

use App\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\InvalidActivationToken;
use App\Mail\Rebase\RefreshWorkspaceToken;
use App\Exceptions\SlugTokenMismatchException;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class ValidateWorkspaceToken extends Controller
{
    public function __invoke(Request $request, string $token)
    {
        if (WorkspaceRepository::isPending($request->get('slug'))) {
            try {
                $matchingWorkspace = WorkspaceRepository::matchSlugAndToken($token, $request->get('slug'));

                if (!WorkspaceRepository::filter($matchingWorkspace)->activationIsOnTime(Carbon::now())) {
                    throw new InvalidActivationToken('Your token has expired');
                }
            } catch (InvalidActivationToken | SlugTokenMismatchException $e) {
                $updatedWorkspace = WorkspaceRepository::factory()->resetActivationToken($request->get('slug'));
                $this->sendEmailToOwners($updatedWorkspace);

                return redirect()->route('validate.workspace.token-expired');
            }

            return inertia(Action::getView($this))->with([
                'token' => $token,
            ]);
        }

        return redirect()->route('login')->withMessage('You are not allowed to do that');
    }

    private function sendEmailToOwners($workspace): void
    {
        $owners = WorkspaceRepository::query($workspace)->getAllOwners();
        $owners->each(function ($item, $key) use ($workspace): void {
            Mail::to($item->email)->send(new RefreshWorkspaceToken($item, $workspace));
        });
    }
}
