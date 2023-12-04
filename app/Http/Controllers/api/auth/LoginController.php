<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => implode(", ", $validator->messages()->all()),
                'data' => []
            ]);
        }
        $seller = Seller::where(['phone' => $request->username])->first();
        if (!$seller) {
            return response()->json([
                'status' => 'failed',
                'message' => "Invalid phone number",
                'data' => []
            ]);
        }

        if (!Hash::check($request->password, $seller->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'You have entered incorrect mobile no or password',
                'data' => []
            ]);
        }

        if ($seller->status == "pending") {
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account is not approved yet.',
                'data' => []
            ]);
        }
        if ($seller->status == "suspended") {
            return response()->json([
                'status' => 'failed',
                'message' => 'Your account is suspended! Please contact with BPPSHOP authority',
                'data' => []
            ]);
        }


        try {
            $token = $seller->createToken('PassportAuthToken')->accessToken;
            if (!$token) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to login',
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'You have logged in successfully',
                'token' => $token,
                'data' => $seller
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
