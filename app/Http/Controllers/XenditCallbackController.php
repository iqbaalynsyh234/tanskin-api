<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    public function handleCallback(Request $request)
    {
        // Extract the callback token from the request
        $callbackToken = $request->input('token');

        // Perform any required actions with the callback token
        // Example: Store the token in the database, associate it with the authenticated user, etc.

        // Redirect the user to a success page or perform any other required actions
        return redirect()->route('home')->with('success', 'Xendit API key authorization successful');
    }
}
