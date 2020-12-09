<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Guest\Registers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\Rebase\SlugIsNotBanned;
use App\Events\Rebase\StartCustomerSignup;

class RegisterStore extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        event(new StartCustomerSignup($request->input()));

        return redirect()->route('register.complete');
    }

    private function rules()
    {
        return [
            'slug' => ['required', 'unique:lookup,slug', 'min:3', 'max:100', new SlugIsNotBanned()],
            'plan' => ['required'],
            'name' => ['required', 'max:200', 'string'],
            'email' => ['required', 'email', 'max:200'],
            'line1' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string', 'max:5'],
            'agreed_to_terms' => ['required'],
            'agreed_to_privacy' => ['required'],
        ];
    }
}
