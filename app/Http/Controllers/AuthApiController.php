<?php

namespace App\Http\Controllers;

use App\Helpers\VerificationHelpers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        $token = $user->createToken('auth_token')->accessToken;


        return response()->json(['status' => true, 'data' => $user, 'token' => $token], 200);
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->accessToken;

//                $user['token'] = $token;


                return response()->json(['status' => true, 'data' => $user, 'token' => $token], 200);
            }
            return response()->json(['status'=>false, 'message' => 'Invalid credentials'], 401);
        } catch
        (\Exception $e) {
            return response()->json(['status'=> false, 'message'=>$e->getMessage()]);
        }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Logged out', 'status' => true]);
    }

    public function user(Request $request)
    {
        $user = auth('api')->user();
        return response()->json(['data' => $user, 'status' => true]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            //add validation here
        ]);
        $user = auth('api')->user();
        $data = $request->all();
        $user->update($data);
        return response()->json(['data' => $user, 'status' => true]);
    }

//    public function forgetPassword(Request $request)
//    {
//        $user = User::where('email', $request->email)->first();
//        if (!$user) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Invalid User',
//            ],);
//        } else {
//
//            $user->password = bcrypt($request->new_password);
//            $user->update();
//
//            return response()->json([
//                'status' => true,
//                'message' => 'Password Reset Successfully.'
//            ]);
//        }
//    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required|string|min:8|max:20',
                'new_password' => 'required|string|min:8|max:20',
            ]);

            $user = User::findOrfail(auth('api')->user()->id);

            if (!(Hash::check($request['old_password'], $user->getAuthPassword()))) {
                return response()->json(['status'=> false, 'message'=>'Your old password does not match with the password you provided. Please try again.']);
            }

            if (strcmp($request['old_password'], $request['new_password']) == 0) {
                return response()->json(['status'=> false, 'message'=>'New Password cannot be same as your old password. Please choose a different password.']);
            }

            $user->password = bcrypt($request['new_password']);
            $user->save();

            return response()->json(['status' => true, 'data' =>[
                'user' => $user,
            ], 'message' => "Password updated successfully"]);
        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['status'=> false, 'message'=>"Server Error. Please try again later."]);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['status'=> false, 'message'=>'User not found with this email.']);
            }

            if ($user->otp_sent_at) {
                $diffInSeconds = (int) Carbon::now()->diffInSeconds($user->otp_sent_at);
            }

            if ($user->otp && $diffInSeconds < 180) {
                return response()->json(['status'=> false, 'message'=>"Verification sent already! Please try again in " . 180 - $diffInSeconds . " seconds."]);
            }

            $email_verification_code = VerificationHelpers::generateVerificationCode();

            $user->otp = $email_verification_code;
            $user->otp_sent_at = Carbon::now();

            $temp_token = $this->generateTemporaryToken();

            if (!$temp_token) {
                return ('Sorry! We cannot process your request at this moment. Please contact customer support for more details.');
            }
            $user->temp_token = $temp_token;
            $user->save();

//            Mail::to($user->email)->send(new \App\Mail\SendOTP($user));

            return response()->json(['status' => true, 'data' =>[
                'temp_token' => $temp_token,
            ], "message" =>"OTP has been sent to your email"]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['status'=> false, 'message'=>"Server Error. Please try again later."]);
        }
    }

    protected function generateTemporaryToken()
    {
        $temp_token = Str::random(60);

        if (User::where('temp_token', $temp_token)->count() == 0) {
            return $temp_token;
        }

        $this->generateTemporaryToken();
    }

    public function verifyOTP(Request $request)
    {
        try {

            $user = User::where('temp_token', $request->temp_token)
                ->where('otp', $request->otp)
                ->first();

            if (!$user) {
                return response()->json(['status'=> false, 'message'=>'The email / otp does not match']);
            }

            if (((int) Carbon::now()->diffInSeconds($user->otp_sent_at)) > 600) {
                return response()->json(['status'=> false, 'message'=>"OTP Expired"]);
            }

            $user->otp_verified_at = Carbon::now();
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'OTP verified !!',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status'=> false, 'message'=>"Server Error. Please try again later."]);
        }
    }

    public function resetPassword(Request $request)
    {
        try {

            $user = User::where('temp_token', $request->temp_token)->where('otp', $request->otp)->first();

            if (!$user) {
                return response()->json(['status'=> false, 'message'=>'The email / otp does not match']);
            }

            $user->password = bcrypt($request->new_password);
            $user->otp = null;
            $user->temp_token = null;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password Reset Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status'=> false, 'message'=>"Server Error. Please try again later."]);
        }
    }

}
