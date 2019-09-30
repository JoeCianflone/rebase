<?php
namespace App\Domain\Services\Blacklists\Controllers;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;

class IndexBlacklistController
{

    public function __invoke(Request $request)
    {
        return Inertia::render(GetView::execute($this));
    }
}