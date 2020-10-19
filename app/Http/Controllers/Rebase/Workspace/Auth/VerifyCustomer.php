<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyCustomer extends Controller
{
    public function __invoke(Request $request, string $token): void
    {
        dd($request->url, $token);
    }
}
