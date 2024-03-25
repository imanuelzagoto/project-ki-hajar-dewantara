<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckTokenExp
{
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Session::has('token'));
        if(Session::has('token')){
            $token = Session::get('token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://gerry.intek.co.id/api/check-token');
            // dd($token);
            if ($response->successful() && $response['valid']) {
                // Token masih valid, lanjutkan ke rute yang diminta
                return $next($request);
            }else {
                return redirect()->route('loginnew')->with('message','Session Habis Silahkan Login Ulang');
            }
        }else {
            return redirect()->route('loginnew')->with('message','Please try again');
        }



    }
}
