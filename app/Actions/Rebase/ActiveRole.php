<?php declare(strict_types=1);

namespace App\Actions\Rebase;

use App\Contracts\Rebase\Actionable;

class ActiveRole implements Actionable
{
    public static function handle(...$payload)
    {
        [$role] = $payload;

        if (is_array($role)) {
            $key = 'role_'.key($role);
            session([
                $key => $role[key($role)],
            ]);
        } else {
            return session('role_'.$role);
        }
    }
}
