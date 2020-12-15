<?php declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Admin\Customers;

use App\Actions\Action;
use App\Domain\Facades\Rebase\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\MemberRepository;
use App\Domain\Facades\Rebase\CustomerRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class CustomerIndex extends Controller
{
    public function __invoke(string $customerID, Request $request)
    {
        $customer = CustomerRepository::query()->getCustomerWithSubscriptions($request->get('customer_id'));
        $invoices = CustomerRepository::filter($customer)->mapInvoiceData();
        $owner = RoleRepository::query()->getFirstAccountOwner();

        return inertia(Action::getView($this), [
            'customer' => $customer,
            'invoices' => $invoices->toArray(),
            'owner' => $owner,
        ]);
    }
}
