<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash; // Import Hash facade

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('assignment')->plainTextToken; // Use plainTextToken instead of accessToken

            return response()->json(['token' => $token, 'message' => 'Logged in Successfully'], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
