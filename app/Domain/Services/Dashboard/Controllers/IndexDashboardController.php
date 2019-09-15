<?php
namespace App\Domain\Services\Dashboard\Controllers;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;

class IndexDashboardController
{

    public function __invoke(Request $request)
    {
        return Inertia::render(GetView::execute($this));
    }
}
