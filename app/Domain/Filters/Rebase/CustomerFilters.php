<?php

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Customer\Customer;

class CustomerFilters extends ModelFilters
{
    private Customer $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function mapInvoiceData()
    {
        return $this->model->invoices()->map(function ($inv, $key) {
            return [
                'id' => $inv->id,
                'link' => route('customer.show.invoice', $inv->id),
                'total' => $inv->total(),
                'invoice_date' => $inv->date()->toFormattedDateString(),
            ];
        });
    }
}
