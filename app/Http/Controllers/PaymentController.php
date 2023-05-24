<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Xendit\Xendit;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
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

        // Create a new payment record
        $payment = new Payment();
        $payment->amount = $request->input('amount');
        $payment->description = $request->input('description');
        $payment->status = 'pending';
        $payment->save();

        // Process payment with Xendit
        $xendit = new Xendit();
        // Call Xendit API methods to process the payment

        // Return the created payment
        return response()->json($payment);
        return response()->message('succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
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

        $payment = Payment::findOrFail($id);
        // Update payment fields based on request data
        $payment->amount = $request->input('amount');
        $payment->description = $request->input('description');
        $payment->status = $request->input('status');
        $payment->save();

        // Return the updated payment
        return response()->message('succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        // Return success response
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
