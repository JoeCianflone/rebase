<?php

declare(strict_types=1);

namespace App\Http\Controllers\Workspace\ConfirmPassword;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Confirm extends Controller
{
    public function __invoke(Request $request): Response
    {
        return inertia(Action::getView($this));
    }
}
