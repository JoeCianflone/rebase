<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Workspaces;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class WorkspaceArchive extends Controller
{
    public function __invoke(string $customerID, string $workspaceID, Request $request)
    {
        WorkspaceRepository::factory()->archive($workspaceID);

        return redirect()->back()->withSuccess('Archived');
    }
}
