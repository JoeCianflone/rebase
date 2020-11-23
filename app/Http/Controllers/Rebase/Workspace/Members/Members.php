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
        $paginatedMembers = WorkspaceRepository::query()->getMembers($request->get('workspace_id'));
        $members = MemberRepository::filter($paginatedMembers)->mapCurrentWorkspaceRole($request->get('workspace_id'));

        return inertia(Action::getView($this), [
            'members' => $members->toArray(),
            'links' => MemberRepository::filter($paginatedMembers)->getPaginatorLinks(),
        ]);
    }
}
