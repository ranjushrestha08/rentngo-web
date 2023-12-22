<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        // Validation logic here

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        // Login logic here

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $token = Auth::user()->createToken('auth_token')->accessToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}
