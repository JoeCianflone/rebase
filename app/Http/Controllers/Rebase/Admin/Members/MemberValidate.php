<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Members;

use App\Actions\Action;
use App\Http\Controllers\Controller;

class MemberValidate extends Controller
{
    public function __invoke(string $customerID, string $memberID, string $token)
    {
        return inertia(Action::getView($this), [
            'customerID' => $customerID,
            'memberID' => $memberID,
            'token' => $token,
        ]);
    }
}
