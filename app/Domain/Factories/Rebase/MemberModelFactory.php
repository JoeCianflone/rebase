<?php declare(strict_types=1);

namespace App\Domain\Factories\Rebase;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Domain\Models\Rebase\Workspace\Member;

class MemberModelFactory extends ModelFactory
{
    public function attachToWorkspace($member, $workspaceID): void
    {
        $member->workspaces()->attach($workspaceID);
    }

    public function addResetToken(): string
    {
        $token = (string)Str::uuid();
        DB::table(config('rebase.paths.db.workspace.name') . '.password_resets')->upsert([
            [
                'email' => $this->builder->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ],
        ], ['email'], ['token', 'created_at']);

        return $token;
    }

    public function removeResetToken(string $email): void
    {
        DB::table(config('rebase.paths.db.workspace.name') . '.password_resets')->where('email', '=', $email)->delete();
    }

    public function resetPassword(string $email, string $password): void
    {
        $this->builder->where('email', '=', $email)->update([
            'password' => Hash::make($password),
        ]);
    }
}
