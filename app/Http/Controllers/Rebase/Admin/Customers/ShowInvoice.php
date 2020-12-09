<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\CustomerRepository;

class ShowInvoice extends Controller
{
    public function __invoke(string $customerID, string $invoiceID, Request $request)
    {
        $customer = CustomerRepository::query()->getCustomerWithSubscriptions($customerID);

        return $customer->downloadInvoice($invoiceID, [
            'vendor' => 'Your Company',
            'product' => 'Your Product',
        ]);
    }
}
