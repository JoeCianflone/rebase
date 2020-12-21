<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Legal;

use Inertia\Response;
use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Privacy extends Controller
{
    public function __invoke(Request $request)
    {
        return inertia(Action::getView($this));
    }
}
