<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function signup(Request $request)
    {
        // Validation logic here
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        

        return response()->json(['token' => $token, 'status' => "success"], 200);
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
            $token = Auth::user()->createToken('auth_token')->accessToken;
            return response()->json(['token' => $token, 'status' => "success"]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out', 'status' => "success"]);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user(), 'status' => "success"]);
    }
}
