<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardIndex extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(GetView::execute($this));
    }
}
