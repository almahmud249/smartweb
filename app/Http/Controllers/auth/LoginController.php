<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
            'password' => 'required|min:8'
        ]);
        $seller = Seller::where(['phone' => $request->phone])->first();
        if (!$seller) {
            return redirect()->back()->with('error', 'Unable to login!');
        }
        if (!Hash::check($request->password, $seller->password)) {
            return redirect()->back()->with('error', 'You have entered incorrect mobile no or password!');
        }
        if ($seller->status == "pending") {
            return redirect()->back()->with('error', 'Your account is not approved yet!');
        }
        if ($seller->status == "suspended") {
            return redirect()->back()->with('error', 'Your account is suspended! Please contact with BPPSHOP authority!');
        }

        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
