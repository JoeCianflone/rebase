<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\Rebase\SlugIsNotBanned;

class RegisterCheckSlug extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate($this->rules());

        return redirect()->route('register.email', [
            'slug' => $request->input('slug'),
        ]);
    }

    private function rules(): array
    {
        return [
            'slug' => ['required', 'unique:lookup,slug', 'min:3', 'max:100', new SlugIsNotBanned()],
        ];
    }
}
