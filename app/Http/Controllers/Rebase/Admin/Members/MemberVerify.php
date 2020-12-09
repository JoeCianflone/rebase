<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Members;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Domain\Facades\Rebase\MemberRepository;

class MemberVerify extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate($this->rules());

        $member = MemberRepository::query()->findMember($request->input('email'))->get();
        $verifiedMember = MemberRepository::filter($member)->matches([
            'id' => $request->input('memberID'),
            'email_token' => $request->input('token'),
        ])->first();

        if (is_null($verifiedMember)) {
            return redirect()->back()->withErrors('We cannot match your email address in our system');
        }

        MemberRepository::factory($verifiedMember)->update([
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
