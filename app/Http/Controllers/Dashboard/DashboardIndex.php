<?php
namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domain\Repositories\Facades\UserRepository;

class DashboardIndex
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(GetView::execute($this));
    }
}
