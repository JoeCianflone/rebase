<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Onboarding;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnboardingComplete extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this));
    }
}
