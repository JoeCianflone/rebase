<?php

declare(strict_types=1);

namespace App\Http\Controllers\Design;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ViewDesign extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this));
    }
}
