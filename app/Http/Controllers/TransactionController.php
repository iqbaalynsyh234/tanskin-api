<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate the request data
         $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Create the transaction record in the database
        $transaction = Transaction::create([
            'amount' => $validatedData['amount'],
            'description' => $validatedData['description'],
        ]);

        // Make the API call to Xendit to create a payment
        $xendit = new Xendit();
        $response = $xendit->createPayment([
            'external_id' => $transaction->id,
            'amount' => $transaction->amount,
            'description' => $transaction->description,
            // Add other required Xendit parameters
        ]);

        // Handle the Xendit API response and update the transaction status
        if ($response['status'] === 'CREATED') {
            $transaction->update([
                'xendit_id' => $response['id'],
                'status' => 'created',
            ]);

            return response()->json([
                'message' => 'Transaction created successfully.',
                'data' => $transaction,
            ], 201);
        } else {
            $transaction->update(['status' => 'failed']);

            return response()->json([
                'message' => 'Failed to create transaction.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }
}
