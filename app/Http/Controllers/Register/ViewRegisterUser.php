<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Actions\Action;
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
        if (!session('cart.slug')) {
            return Redirect::route('view.register.workspace');
        }

        return inertia(Action::getView($this), [
            'slug' => session('cart.slug'),
        ])->withViewData('stripe', true);
    }
}
