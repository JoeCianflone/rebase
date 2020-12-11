<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Members;

use Inertia\Inertia;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\MemberRepository;

class MemberIndex extends Controller
{
    public function __invoke(Request $request)
    {
        $members = MemberRepository::query()->allCustomerMembers(withRoles: true)
                                            ->filterBy($request->input('s'), ['name', 'email'])
                                            ->paginate(count: (int) $request->input('count') ?? 25, order: ['col' => 'name', 'direction' => 'asc']);

        return inertia(Action::getView($this), [
            'members' => MemberRepository::filter($members)->getPaginatorItems(),
            'links' => MemberRepository::filter($members)->getPaginatorLinks(),
        ]);
    }

}
