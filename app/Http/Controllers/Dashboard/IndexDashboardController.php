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


        if ($request->getMethod() === 'GET') {
            return Inertia::render(GetView::execute($this), [])->withViewData('stripe', false);
        }


        $x = [
            [
                'id' => 22,
                'name' => 'Joe',
                'email' => 'joe@cianflone.co',
            ],[
                'id' => 23,
                'name' => 'Joe',
                'email' => 'joe@cianflone.co',
            ]
        ];


        return Inertia::render(GetView::execute($this), [
            'user' => $user->transform($x)
        ])->withViewData('stripe', false);
    }
}
