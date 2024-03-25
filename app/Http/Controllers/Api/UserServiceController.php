<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserServiceController extends Controller
{
    public function loginUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $client = new Client();

        try {
            $response = $client->post('https://gerry.intek.co.id/api/login', [
                'form_params' => [
                    'email' => $email,
                    'password' => $password,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['token'])) {
                // return response()->json(['message' => 'Login success!', 'token' => $data['token'], 'data' => $data]);
                return redirect('/dashboard');
            } else {
                return response()->json(['message' => 'Login failed. Invalid email or password.']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getUserData(Request $request)
    {
        $user = $request->user();

        return response()->json(['data' => $user]);
    }
}
