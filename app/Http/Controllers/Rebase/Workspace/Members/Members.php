<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Members;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class Members extends Controller
{
    public function __invoke(Request $request)
    {
        $members = MemberRepository::filter(
            WorkspaceRepository::query()->getAllMembers($request->get('workspace_id'))
        )->mapCurrentWorkspaceRole($request->get('workspace_id'));

        return inertia(Action::getView($this), [
            'members' => $members->toArray(),
        ]);
    }
}
