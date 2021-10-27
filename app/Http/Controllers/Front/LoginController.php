<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'login_email' => 'required|min:3|max:30',
                'login_password' => 'required|min:8|max:20',
            ],
            [
                'login_email.required' => __('words.email-required'),
                'login_email.min' => __('words.email-min', ['min' => ':min']),
                'login_email.max' => __('keywwordsords.email-max', ['max' => ':max']),

                'login_password.required' => __('words.password-required'),
                'login_password.min' => __('words.password-min', ['min' => ':min']),
                'login_password.max' => __('words.password-max', ['max' => ':max']),
            ]
        );

        $credentials = [
            'email' => $request->login_email,
            'password' => $request->login_password,
            'status' => 0
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => __('words.login-success'), 'status' => 200]);
        } else {
            return response()->json(['message' => __('words.login-error'), 'status' => 201]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Web.main')->with('success', __('words.logout-success'));
    }
}
