<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Members;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class WorkspaceMemberIndex extends Controller
{
    public function __invoke(Request $request) {
        $paginatedMembers = WorkspaceRepository::query()
            ->getMembers($request->get('workspace_id'))
            ->filterBy($request->input('s'), ['name', 'email'])
            ->paginate(10);

        $member = MemberRepository::filter($paginatedMembers)->getPaginatorItems();
        dd ($member[0]);

//        $members = MemberRepository::filter($paginatedMembers)->mapCurrentWorkspaceRole($request->get('workspace_id'));

        return inertia(Action::getView($this), [
            'members' => MemberRepository::filter($paginatedMembers)->getPaginatorItems(),
            'links' => MemberRepository::filter($paginatedMembers)->getPaginatorLinks(),
        ]);
    }
}
