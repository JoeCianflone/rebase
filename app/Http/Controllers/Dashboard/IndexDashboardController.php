<?php
namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Domain\Resources\UserResource;

class IndexDashboardController
{
    public function __invoke(Request $request)
    {
        if ($request->getMethod() === 'GET') {
            return Inertia::render(GetView::execute($this), [])->withViewData('stripe', false);
        }

        return Inertia::render(GetView::execute($this), [UserResource::collection($request)])->withViewData('stripe', false);
    }
}
