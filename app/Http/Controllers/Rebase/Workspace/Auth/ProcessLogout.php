<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProcessLogout extends Controller
{
    public function __invoke(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withMessage('Have a nice day');
    }
}
