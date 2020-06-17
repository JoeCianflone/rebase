<?php

declare(strict_types=1);

namespace App\Http\Controllers\Open\Registration;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ViewRegistration extends BaseController
{
    public function __invoke(Request $request): Response
    {
        dd('Hi registration');

        return Inertia::render(GetView::execute($this));
    }
}
