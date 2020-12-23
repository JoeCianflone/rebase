<?php declare(strict_types=1);

namespace App\Domain\Builders\Rebase;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Domain\Builders\Rebase\ModelBuilder;

class MemberBuilder extends ModelBuilder
{
    public function byEmail(string $email)
    {
        $this->where('email', $email);

        return $this;
    }

    public function canResetPassword(string $email, string $token): bool
    {
        $resetter = DB::table(config('paths.db.workspace.name').'.password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (is_null($resetter)) {
            return false;
        }

        $maxTokenTime = Carbon::parse($resetter->created_at)->addHours(1);

        return $maxTokenTime->gte(Carbon::now());
    }
}
