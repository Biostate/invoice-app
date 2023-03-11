<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShortInvoiceCollection;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = auth()->user()->invoices()->orderBy('created_at', 'desc')->paginate(10);

        return  new ShortInvoiceCollection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: add validation here

        $invoiceData = $request->only(
            [
                'from_street_address',
                'from_city',
                'from_post_code',
                'from_country',
                'to_street_address',
                'to_city',
                'to_post_code',
                'to_country',
                'description',
                'client_name',
                'client_email',
                'payment_terms',
                'invoice_date',
            ]
        );

        $invoiceData['id'] = fake()->bothify('??####');
        $invoiceData['status'] = Invoice::STATUS_PENDING;
        $invoiceData['payment_due'] = now()->addDays($request['payment_due']);

        $invoice = auth()->user()->invoices()->create($invoiceData);

        $invoice->items()->createMany(
            $request->items
        );

        $data = new \App\Http\Resources\InvoiceResource($invoice);

        return response()->apiResponse(
            data: $data
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $this->authorize('view', $invoice);

        $invoice->load('items');

        $data = new \App\Http\Resources\InvoiceResource($invoice);

        return response()->apiResponse(
            data: $data
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $this->authorize('update', $invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $this->authorize('delete', $invoice);
    }
}
