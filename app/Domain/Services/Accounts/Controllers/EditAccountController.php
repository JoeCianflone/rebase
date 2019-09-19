<?php
namespace App\Domain\Services\Accounts\Controllers;

use Inertia\Inertia;
use App\Actions\GetView;
use Illuminate\Http\Request;

class EditAccountController
{

    public function __invoke(Request $request)
    {
        return Inertia::render(GetView::execute($this));
    }
}