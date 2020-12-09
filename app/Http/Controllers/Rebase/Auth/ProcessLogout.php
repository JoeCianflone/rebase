<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth;

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

        return redirect()->route('signin', ['customer_id' => $request->get('customer_id')])->withSuccess('Thank you and have a nice day');
    }
}
