<?php
namespace App\Domain\Services\Teams\Controllers;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;

class UpdateTeamController
{

    public function __invoke(Request $request)
    {
        return Inertia::render(GetView::execute($this));
    }
}