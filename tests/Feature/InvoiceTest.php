<?php

namespace Tests\Feature;

use App\Events\InvoiceItemCreated;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_create_invoice(): void
    {
        $invoice = Invoice::factory()->create();

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
        ]);
    }

    public function test_should_create_invoice_item(): void
    {
        $invoice = InvoiceItem::factory()->create();

        $this->assertDatabaseHas('invoice_items', [
            'id' => $invoice->id,
        ]);
    }

    public function test_should_dispatch_invoice_item_created_event(): void
    {
        Event::fake();

        InvoiceItem::factory()->create();

        Event::assertDispatched(InvoiceItemCreated::class);
    }

    public function test_calculate_invoice_total_after_invoice_item_created(): void
    {
        $invoice = Invoice::factory()->hasItems(3)->create();

        $total = $invoice->items()->sum(DB::raw('quantity * price'));

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'total' => $total,
        ]);
    }
}
