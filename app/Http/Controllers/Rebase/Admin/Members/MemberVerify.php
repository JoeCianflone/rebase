<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Members;

use App\Domain\Models\Rebase\Workspace\Member;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MemberVerify extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate($this->rules());

        $member = Member::byEmail($request->input('email'))->first();

        if (! $member->isVerified($request->input('memberID'), $request->input('token'))) {
            return redirect()->back()->withErrors('We cannot match your email address in our system');
        }

        $member->update([
            'password' => Hash::make($request->input('password')),
            'email_token' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        $request->session()->flash('success', 'Password has been set you can log in now!');

        return Inertia::location(route('signin', ['customer_id' => $request->input('customerID')]));
    }

    private function rules(): array
    {
        return [
            'email' => ['required'],
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
