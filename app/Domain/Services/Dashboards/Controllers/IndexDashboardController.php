<?php
namespace App\Domain\Services\Dashboards\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class IndexDashboardController
{

    public function __invoke(Request $request)
    {
        return Inertia::render("Dashboards/IndexDashboard");
    }
}
