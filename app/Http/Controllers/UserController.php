<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $userProfileServiceUrl = env('USER_SERVICE_URL');
        $response = Http::post("$userProfileServiceUrl/auth/login", $request->all());

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Authentication failed'], 500);
        }
    }

    public function signup(Request $request)
    {
        $userProfileServiceUrl = env('USER_SERVICE_URL');
        $response = Http::post("$userProfileServiceUrl/auth/register", $request->all());

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Signup failed'], 500);
        }
    }

    public function profile(Request $request)
    {
        $userProfileServiceUrl = env('USER_SERVICE_URL');
        $response = Http::withHeaders([
            'Authorization' => $request->header('Authorization'),
        ])->get("$userProfileServiceUrl/user/profile");

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Profile retrieval failed'], 500);
        }
    }
}
