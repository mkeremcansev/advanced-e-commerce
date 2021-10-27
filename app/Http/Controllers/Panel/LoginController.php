<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|min:3|max:30',
                'password' => 'required|min:8|max:20',
            ],
            [
                'email.required' => __('words.email-required'),
                'email.min' => __('words.email-min', ['min' => ':min']),
                'email.max' => __('keywwordsords.email-max', ['max' => ':max']),

                'password.required' => __('words.password-required'),
                'password.min' => __('words.password-min', ['min' => ':min']),
                'password.max' => __('words.password-max', ['max' => ':max']),
            ]
        );

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
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
        return redirect()->route('Panel.login')->with('success', __('words.logout-success'));
    }
}
