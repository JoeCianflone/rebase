<?php
namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class IndexDashboardController
{
    public function __invoke(Request $request, UserResource $user)
    {
        return Inertia::render(GetView::execute($this), [])->withViewData('stripe', false);
    }
}
