<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth\ForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\MemberRepository;

class ProcessReset extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate($this->rules());

        if (Member::canResetPassword($request->input('email'), $request->input('token'))) {
            MemberRepository::modelFactory()->resetPassword($request->input('email'), $request->input('password'));
            $request->session()->flash('success', 'Your password has been reset');
        } else {
            $request->session()->flash('alert', 'Token expired or Email invalid');
        }

        MemberRepository::modelFactory()->removeResetToken($request->input('email'));

        return redirect()->route('signin', ['customer_id' => $request->query('customer_id')]);
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'max:250',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[\S]/',       // must contain a special character,
            ],
        ];
    }
}
