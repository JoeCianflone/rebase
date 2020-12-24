<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Onboarding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\Rebase\WorkspaceStatus;
use App\Domain\Models\Rebase\Workspace\Workspace;

class OnboardingComplete extends Controller
{
    public function __invoke(Request $request)
    {
        Workspace::modelFactory()->update(whereCol: 'sub', whereValue: $request->get('sub'), update: [
            'status' => WorkspaceStatus::ACTIVE(),
        ]);

        return redirect()->route('dashboard')->withMessage('Activation Complete');
    }
}
