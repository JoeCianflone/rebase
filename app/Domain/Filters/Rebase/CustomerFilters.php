<?php

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Customer\Customer;

class CustomerFilters extends ModelFilters
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function mapInvoiceData()
    {
        $customerID = $this->model->id;

        return $this->model->invoices()->map(function ($inv, $key) use ($customerID) {
            return [
                'id' => $inv->id,
                'link' => route('customer.invoice.show', ['customerID' => $customerID, 'invoiceID' => $inv->id]),
                'total' => $inv->total(),
                'invoice_date' => $inv->date()->toFormattedDateString(),
            ];
        });
    }
}
