<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Customers;

use App\Domain\Models\Rebase\Admin\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowInvoice extends Controller
{
    public function __invoke(string $customerID, string $invoiceID, Request $request)
    {
        $customer = Customer::withSubscriptions($customerID)->first();

        return $customer->downloadInvoice($invoiceID, [
            'vendor' => 'Rebase',
            'product' => 'Product Awesomeness',
        ], 'My-Invoice');
    }
}
