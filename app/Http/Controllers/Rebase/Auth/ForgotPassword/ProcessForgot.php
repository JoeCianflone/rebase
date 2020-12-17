<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Auth\ForgotPassword;

use Illuminate\Http\Request;
use App\Mail\Rebase\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Domain\Models\Rebase\Workspace\Member;

class ProcessForgot extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate($this->rules());
        $member = Member::byEmail($request->input('email'))->first();


        if (!is_null($member)) {
           $token = Member::modelFactory()->addResetToken($member->email);
            Mail::to($member->email)->send(new PasswordReset($token, $request->get('customer_id')));
        }

        return redirect()->back()->withMessage('Thank you, we will send you an email if we can find your email address');
    }

    private function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
