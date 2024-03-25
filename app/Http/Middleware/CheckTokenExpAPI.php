<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckTokenExpAPI
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Authorization')) {
            $token = str_replace('Bearer ', '', $request->header('Authorization'));
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://gerry.intek.co.id/api/check-token');

            if ($response->successful() && $response['valid']) {
                return $next($request);
            } else {
                return response()->json([
                    'message' => 'Invalid token or session expired.',
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized. Missing Authorization header.',
            ], 401);
        }
    }
}
