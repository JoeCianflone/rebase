<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\GetView;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardIndex
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(GetView::execute($this));
    }
}
