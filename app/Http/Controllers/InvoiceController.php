<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        // Retrieve all invoices
        $invoices = Invoice::all();

        return response()->json($invoices);
    }

    public function show($id)
    {
        // Retrieve a specific invoice
        $invoice = Invoice::findOrFail($id);

        return response()->json($invoice);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required',
            // Add more validation rules as per your invoice schema
        ]);

        // Create a new invoice
        $invoice = Invoice::create($validatedData);

        return response()->json($invoice, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'numeric',
            'description' => 'string',
            // Add more validation rules as per your invoice schema
        ]);

        // Find the invoice and update its attributes
        $invoice = Invoice::findOrFail($id);
        $invoice->update($validatedData);

        return response()->json($invoice);
    }

    public function destroy($id)
    {
        // Find the invoice and delete it
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted']);
    }
}
