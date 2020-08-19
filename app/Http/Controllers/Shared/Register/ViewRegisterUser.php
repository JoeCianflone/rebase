<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Register;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as BaseController;

class ViewRegisterUser extends BaseController
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if (!session('account.workspace')) {
            return Redirect::route('view.register.workspace');
        }

        return Inertia::render(GetView::execute($this, 'rebase'), [
            'slug' => session('account.workspace'),
        ])->withViewData('stripe', true);
    }
}
