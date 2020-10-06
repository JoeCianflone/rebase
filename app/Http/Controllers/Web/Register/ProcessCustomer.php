<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Register;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Facades\MemberRepository;
use App\Domain\Facades\CustomerRepository;
use Laravel\Cashier\Exceptions\PaymentFailure;
use App\Http\Requests\RegisterNewCustomerRequest;

class ProcessCustomer extends Controller
{
    /**
     * @return mixed
     */
    public function __invoke(RegisterNewCustomerRequest $request)
    {
        // Move to pipeline
        $customer = CustomerRepository::create([
            'name' => $request->input('name'),
            'is_business' => $request->input('is_business'),
            'business_name' => $request->input('business_name'),
            'agreed_to_terms' => $request->input('agreed_to_terms'),
            'agreed_to_privacy' => $request->input('agreed_to_privacy'),
        ]);

        $customer->customerAddresses()->create([
            'is_primary' => true,
            'line1' => $request->input('address_line1'),
            'line2' => $request->input('address_line2'),
            'line3' => $request->input('address_line3'),
            'unit_number' => $request->input('unit_number'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
        ]);

        try {
            $customer->newSubscription(config('pricing.plan.test'), $request->input('plan'))
                ->create(
                    $request->input('payment_method'),
                    [
                        'name' => $customer->business_name ?? $customer->name,
                        'email' => $request->input('email'),
                        'address' => [
                            'line1' => $request->input('address_line1'),
                            'line2' => $request->input('address_line2'),
                            'city' => $request->input('city'),
                            'state' => $request->input('state'),
                            'postal_code' => $request->input('postal_code'),
                        ],
                    ]
                );
        } catch (PaymentFailure $e) {
            // event('Payment Failure...');
            dd($e);

            return false;
        }

        $workspaceName = $customer->is_business ? $customer->business_name : $customer->name;
        $workspaceName = Str::plural($workspaceName);

        $customer->workspaces()->create([
            'name' => "{$workspaceName} Workspace",
            'slug' => $request->input('slug'),
        ]);

        Artisan::call("db:migrate {$customer->id} --seed");

        $member = MemberRepository::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        $member->roles()->attach(1, ['workspace_id' => $customer->workspaces()->first()->id]);

        dd('done?');
    }
}
