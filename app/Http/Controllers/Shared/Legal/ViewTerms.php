<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared\Legal;

use Inertia\Inertia;
use Inertia\Response;
use App\Actions\GetView;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class ViewTerms extends BaseController
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render(GetView::execute($this, 'rebase'));
    }
}
