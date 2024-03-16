<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 

class AuthApiController extends Controller
{
    public function signup(Request $request)
    {
        // Validation logic here
        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email',
        //     'phone' => 'required|string|unique:users,phone', 
        //     'password' => 'required|min:8',
        //     'role' => 'required|string'
        // ]);

       $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|unique:users,phone',
        'password' => 'required|min:8',
        'role' => 'required|string'
        ]);

         if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => bcrypt($request->password),
        //     'role' => $request->role,
        // ]);
        
 $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        

        return response()->json([ 'status' => "success", 'data' => $user, 'token' => $token], 200);
    }

    public function login(Request $request)
    {

        $user = [];

        if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;



         return response()->json([ 'status' => "success", 'data' => $user, 'token' => $token], 200);
        }return response()->json(['message' => 'Invalid credentials'], 401);
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
