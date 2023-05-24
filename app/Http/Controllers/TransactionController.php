<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Retrieve all transactions
        $transactions = Transaction::all();

        return response()->json($transactions);
    }

    public function show($id)
    {
        // Retrieve a specific transaction
        $transaction = Transaction::findOrFail($id);

        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required',
            // Add more validation rules as per your transaction schema
        ]);

        // Create a new transaction
        $transaction = Transaction::create($validatedData);

        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'numeric',
            'description' => 'string',
            // Add more validation rules as per your transaction schema
        ]);

        // Find the transaction and update its attributes
        $transaction = Transaction::findOrFail($id);
        $transaction->update($validatedData);

        return response()->json($transaction);
    }

    public function destroy($id)
    {
        // Find the transaction and delete it
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted']);
    }
}
