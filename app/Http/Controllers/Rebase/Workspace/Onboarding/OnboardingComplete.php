<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Onboarding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\Rebase\WorkspaceStatus;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class OnboardingComplete extends Controller
{
    public function __invoke(Request $request)
    {
        WorkspaceRepository::factory()->update('slug', $request->get('slug'), [
            'status' => WorkspaceStatus::ACTIVE(),
        ]);

        return redirect()->route('dashboard')->withMessage('Activation Complete');
    }
}
