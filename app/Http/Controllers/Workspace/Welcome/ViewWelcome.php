<?php

declare(strict_types=1);

namespace App\Http\Controllers\Workspace\Welcome;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ViewWelcome extends BaseController
{
    public function __invoke(Request $request): Response
    {
        dd("Hi there I'm in Welcome");

        return Inertia::render(GetView::execute($this));
    }
}
