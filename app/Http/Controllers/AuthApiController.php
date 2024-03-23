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
        $user = auth('api')->user();
        return response()->json(['user' => $user, 'status' => "success"]);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            //add validation here
        ]);     
        $user = auth('api')->user();
        $data = $request->all();
        $user->update($data);
        return response()->json(['user' => $user, 'status' => "success"]);
    }

   public function forgetPassword(Request $request){
    $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid User',
                ],);
            } else {

                $user ->password = bcrypt($request->new_password);
                $user ->update();

                return response()->json([
                    'status' => true,
                    'message' => 'Password Reset Successfully.'
                ]);
            }
   }
}
