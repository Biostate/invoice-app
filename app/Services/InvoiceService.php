<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceService implements InvoiceServiceInterface
{
    public function calculateInvoiceTotal(Invoice $invoice): void
    {
        $total = $invoice->items()->sum(DB::raw('quantity * price'));

        $invoice->update([
            'total' => $total,
        ]);
    }
}
