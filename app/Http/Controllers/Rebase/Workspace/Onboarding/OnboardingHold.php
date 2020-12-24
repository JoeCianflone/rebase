<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Onboarding;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Rebase\OnboardReminder;
use Illuminate\Support\Facades\Mail;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class OnboardingHold extends Controller
{
    public function __invoke(Request $request)
    {
        // TODO: this is a code-smell...
        if (!session('halt-email')) {
            // event(new Alert(WorkspaceRepository::getAllOwnersFor($request->get('workspace_id'), '');
            // $owners = WorkspaceRepository::getAllOwnersFor($request->get('workspace_id'));
            // $owners->each(function ($item, $key) use ($request): void {
            //     Mail::to($item->email)->send(new OnboardReminder($item->email, $request->get('sub')));
            // });
        }
        session(['halt-email' => true]);
        // ....

        return inertia(Action::getView($this));
    }
}
