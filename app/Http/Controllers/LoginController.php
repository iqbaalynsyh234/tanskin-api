<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function login(Request $request)
    {
        $credentials = $request->only('api_key');

        if (Auth::once($credentials)) {
            // Perform any additional login logic if required
            return response()->json(['message' => 'Login successful']);
        }

        return response()->json(['error' => 'Invalid API key'], 401);
    }
}
