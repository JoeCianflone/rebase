<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterCheckEmail extends Controller
{
    public function __invoke(Request $request)
    {
        // This generats a 409 Conflict on purpose see InertiaJS
        // docs for more info: https://inertiajs.com
        return Inertia::location(route('register.customer', [
            'sub' => $request->input('sub'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
        ]));
    }
}
