<?php

declare(strict_types=1);

namespace App\Http\Controllers\Open\Find;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ViewFind extends BaseController
{
    public function __invoke(Request $request): Response
    {
        dd('hello there find');

        return Inertia::render(GetView::execute($this));
    }
}
