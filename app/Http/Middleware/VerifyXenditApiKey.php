<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyXenditApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('Authorization');

        if ($this->isValidApiKey($apiKey)) {
            return $next($request);
        }

        return response()->json(['error' => 'Invalid API key'], 401);
    }

    private function isValidApiKey($apiKey)
    {
        $xenditApiKey = config('services.xendit.api_key');
        return $apiKey === $xenditApiKey;
    }
}
