<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Members;

use Inertia\Inertia;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Facades\Rebase\MemberRepository;

class MemberIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $members = Member::with(['roles', 'workspaces'])->paginate(10);

        return inertia(Action::getView($this), [
            'members' => $members->toArray(),
        ]);
    }

}
