<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rebase\Workspace\Customer;

use App\Actions\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Facades\Rebase\CustomerRepository;
use App\Domain\Facades\Rebase\WorkspaceRepository;

class Settings extends Controller
{
    public function __invoke(Request $request)
    {
        $customer = CustomerRepository::query()->getCustomerWithSubscriptions($request->get('customer_id'));
        $invoices = CustomerRepository::filter($customer)->mapInvoiceData();
        $workspaces = WorkspaceRepository::query()->getAll();

        return inertia(Action::getView($this), [
            'customer' => $customer,
            'invoices' => $invoices->toArray(),
            'workspaces' => $workspaces->toArray(),
        ]);
    }
}
