<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\CustomerRepository;

class ShowInvoice extends Controller
{
    public function __invoke(string $invoiceID, Request $request)
    {
        $customer = CustomerRepository::getCustomerWithSubscriptions($request->get('customer_id'));

        return $customer->downloadInvoice($invoiceID, [
            'vendor' => 'Your Company',
            'product' => 'Your Product',
        ]);
    }
}
