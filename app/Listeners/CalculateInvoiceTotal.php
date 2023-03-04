<?php

namespace App\Listeners;

use App\Services\InvoiceServiceInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateInvoiceTotal
{
    /**
     * Create the event listener.
     */
    public function __construct(private InvoiceServiceInterface $invoiceService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->invoiceService->calculateInvoiceTotal($event->invoiceItem->invoice);
    }
}
