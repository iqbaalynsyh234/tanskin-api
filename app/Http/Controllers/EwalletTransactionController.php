<?php

namespace App\Http\Controllers;


use App\Models\EwalletTransaction;
use Illuminate\Http\Request;
use Xendit\Xendit;

class EwalletTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = EwalletTransaction::all();
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate request data

        // Create a new transaction record
        $transaction = new EwalletTransaction();
        $transaction->amount = $request->input('amount');
        $transaction->description = $request->input('description');
        $transaction->status = $request->input('pending','done');
        $transaction->ewallet_type = $request->input('ewallet_type');
        $transaction->save();

        // Process transaction with Xendit
        $xendit = new Xendit();
        // Call Xendit API methods to process the transaction

        // Return the created transaction
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = EwalletTransaction::findOrFail($id);
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate request data

        $transaction = EwalletTransaction::findOrFail($id);
        // Update transaction fields based on request data
        $transaction->amount = $request->input('amount');
        $transaction->description = $request->input('description');
        $transaction->status = $request->input('status');
        $transaction->ewallet_type = $request->input('ewallet_type');
        $transaction->save();

        // Return the updated transaction
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = EwalletTransaction::findOrFail($id);
        $transaction->delete();

        // Return success response
        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
