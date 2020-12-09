<?php declare(strict_types=1);

namespace App\Domain\Filters\Rebase;

use App\Domain\Models\Rebase\Admin\Customer;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

class CustomerFilters extends ModelFilters
{
    #[Pure]
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function mapInvoiceData(): Collection
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
