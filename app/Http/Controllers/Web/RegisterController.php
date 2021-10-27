<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $fill = $request->validate(
            [
                'name' => 'required|min:3|max:30',
                'phone' => 'required|min:10|max:13||unique:users',
                'email' => 'required|email|min:5|max:30|unique:users',
                'password' => 'required|min:8|max:20',
                'repeat' => 'required|min:8|same:password',
                'policy' => 'required',
            ],
            [
                'name.required' => __('words.name-surname-required'),
                'name.min' => __('words.name-surname-min', ['min' => ':min']),
                'name.max' => __('words.name-surname-max', ['max' => ':max']),

                'username.required' => __('words.username-required'),
                'username.min' => __('words.username-min', ['min' => ':min']),
                'username.max' => __('words.username-max', ['max' => ':max']),
                'username.unique' => __('words.username-unique'),


                'phone.required' => __('words.phone-required'),
                'phone.min' => __('words.phone-min', ['min' => ':min']),
                'phone.max' => __('words.phone-max', ['max' => ':max']),
                'phone.unique' => __('words.phone-unique'),

                'email.required' => __('words.email-required'),
                'email.email' => __('words.email-required'),
                'email.min' => __('words.email-min', ['min' => ':min']),
                'email.max' => __('words.email-max', ['max' => ':max']),
                'email.unique' => __('words.email-unique'),

                'password.required' => __('words.password-required'),
                'password.min' => __('words.password-min', ['min' => ':min']),
                'password.max' => __('words.password-max', ['max' => ':max']),
                'password.confirmed' => __('words.password-confirmed'),

                'repeat.required' => __('words.repeat-required'),
                'repeat.min' => __('words.repeat-min', ['min' => ':min']),
                'repeat.max' => __('words.repeat-max', ['max' => ':max']),
                'repeat.same' => __('words.password-confirmed'),

                'policy.required' => __('words.policy-required'),
            ]
        );
        $verify = Str::random(20);
        $register = new User;
        $register->fill($fill);
        $register->password = Hash::make($request->password);
        $register->verification = $verify;
        $register->reset = Str::random(20);
        $register->save();
        return response()->json(['success' => __('words.register-success')]);
    }
}
