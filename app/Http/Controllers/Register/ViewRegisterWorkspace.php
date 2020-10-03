<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use Inertia\Response;
use App\Actions\Action;
use App\Enums\MemberRole;
use App\Domain\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\MemberRepository;
use App\Domain\Facades\CustomerRepository;
use App\Domain\Facades\WorkspaceRepository;
use App\Http\Controllers\Controller as BaseController;

class ViewRegisterWorkspace extends BaseController
{
    public function __invoke(Request $request): Response
    {

        $customer = CustomerRepository::create([
            'name' => "Joe Cianflone",
            'agreed_to_terms_at' => true,
            'agreed_to_privacy_at' => true,
        ]);

        $workspace = WorkspaceRepository::create([
          'customer_id' => $customer->id,
          'name' => 'Joe Cianflone Workspace',
          'slug' => 'floop2',
        ]);

        Artisan::call("db:migrate {$customer->id} --seed");

        $member = MemberRepository::create([
            'name' => 'Joe Cianflone',
            'email' => 'joe@cianflone.co',
        ]);


        $member->roles()->attach(1, ['workspace_id' => $workspace->id]);



        // dd ($member->roles);



        return inertia(Action::getView($this))->withViewData('stripe', true);
    }
}
