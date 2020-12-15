<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Workspaces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class WorkspaceIndex extends Controller
{
    public function __invoke(string $customerID, Request $request)
    {
        $workspaces = WorkspaceRepository::query()->getWorkspacesAndMembers(
            paginate: 10,
            searchFields: ['name'],
            searchTerms: $request->input('s'),
            order: 'name',
        );

        return inertia(Action::getView($this), [
            'workspaces' => $workspaces->toArray()
        ]);
    }
}
