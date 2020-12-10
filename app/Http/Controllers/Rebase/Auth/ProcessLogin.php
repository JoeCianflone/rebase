<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProcessLogin extends Controller
{
    public function __invoke(Request $request): Response|RedirectResponse
    {
        $request->validate($this->rules());

        if (!Auth::attempt($request->only('email', 'password'), $request->get('remember'))) {
            return redirect()->back()->withErrors('We cannot find your username/password');
        }

        if ($request->query('to') === 'null' || is_null($request->query('to'))) {
            return Inertia::location(route('pick', $request->query('customer_id')));
        }

        return Inertia::location(str_replace(config('rebase.subdomains.auth'), $request->query('to'), route('dashboard')));
    }

    private function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}
