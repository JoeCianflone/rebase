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
