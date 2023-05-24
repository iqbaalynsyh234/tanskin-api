<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XenditAuthController extends Controller
{
    public function authorize(Request $request)
    {
        // Redirect the user to the Xendit authorization URL
        $xenditAuthUrl = 'https://api.xendit.co/v2/oauth2/authorize?client_id=' . config('services.xendit.client_id') . '&redirect_uri=' . route('xendit.callback');
        return redirect()->away($xenditAuthUrl);
    }
}
