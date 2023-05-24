<?php

namespace App\Http\Controllers;

use Xendit\Xendit;
use Illuminate\Http\Request;

class PayoutLinkController extends Controller
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
    public function create(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'external_id' => 'required|string',
            'amount' => 'required|numeric',
            'email' => 'required|email',
            'description' => 'required|string',
        ]);

        // Make the API call to Xendit to create a payout link
        $xendit = new Xendit();
        $response = $xendit->createPayoutLink([
            'external_id' => $validatedData['external_id'],
            'amount' => $validatedData['amount'],
            'payer_email' => $validatedData['email'],
            'description' => $validatedData['description'],
            // Add other required Xendit parameters
        ]);

        // Handle the Xendit API response
        if ($response['status'] === 'ACTIVE') {
            return response()->json([
                'message' => 'Payout link created successfully.',
                'data' => $response,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create payout link.',
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
