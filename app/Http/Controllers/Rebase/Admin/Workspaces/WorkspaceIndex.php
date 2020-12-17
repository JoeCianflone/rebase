<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Workspaces;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Models\Rebase\Workspace\Workspace;

class WorkspaceIndex extends Controller
{
    public function __invoke(string $customerID, Request $request)
    {
        $workspaces = Workspace::get();

        return inertia(Action::getView($this), [
            'workspaces' => $workspaces->toArray()
        ]);
    }
}
