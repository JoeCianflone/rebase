<?php
namespace App\Domain\Traits\Rebase\ModelTransformers;

trait CustomerTransformers {

    public function mapInvoices()
    {
        $customerID = $this->id;

        return $this->invoices()->map(function ($inv, $key) use ($customerID) {
            return [
                'id' => $inv->id,
                'link' => route('customer.invoice.show', ['customerID' => $customerID, 'invoiceID' => $inv->id]),
                'total' => $inv->total(),
                'invoice_date' => $inv->date()->toFormattedDateString(),
            ];
        });
    }
}
