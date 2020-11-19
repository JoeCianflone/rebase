<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\CustomerRepository;

class CustomerUpdate extends Controller
{
    public function __invoke(?string $type = null, Request $request)
    {
        if ($type === 'address') {
            $validatedData = $request->validate([
                'billingAddress.line1' => ['required'],
                'billingAddress.line2' => ['nullable', 'string'],
                'billingAddress.line3' => ['nullable', 'string'],
                'billingAddress.unit_number' => ['nullable', 'string'],
                'billingAddress.city' => ['required'],
                'billingAddress.state' => ['required', 'max:2'],
                'billingAddress.postal_code' => ['required', 'max:5'],
            ])['billingAddress'];
        }

        CustomerRepository::factory()->update('id', $request->get('customer_id'), $validatedData);

        return redirect()->back()->withSuccess('Updated '.ucfirst($type));
    }
}
