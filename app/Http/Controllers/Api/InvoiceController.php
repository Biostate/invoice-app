<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = auth()->user()->invoices()->paginate(10);

        $data = \App\Http\Resources\ShortInvoiceResource::collection($invoices);

        return response()->apiResponse(
            data: $data
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
