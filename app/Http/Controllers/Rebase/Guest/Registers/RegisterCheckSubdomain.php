<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\Rebase\SubdomainIsNotBanned;

class RegisterCheckSubdomain extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate($this->rules());

        return redirect()->route('register.email', [
            'sub' => $request->input('sub'),
        ]);
    }

    private function rules(): array
    {
        return [
            'sub' => ['required', 'unique:lookup,sub', 'min:3', 'max:100', new SubdomainIsNotBanned()],
        ];
    }
}
