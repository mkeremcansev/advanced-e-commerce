<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function put(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:8|max:20',
                'repeat' => 'required|min:8|same:password',
            ],
            [
                'password.required' => __('words.password-required'),
                'password.min' => __('words.password-min', ['min' => ':min']),
                'password.max' => __('words.password-max', ['max' => ':max']),
                'password.confirmed' => __('words.password-confirmed'),

                'repeat.required' => __('words.repeat-required'),
                'repeat.min' => __('words.repeat-min', ['min' => ':min']),
                'repeat.max' => __('words.repeat-max', ['max' => ':max']),
                'repeat.same' => __('words.password-confirmed'),
            ]
        );
        $user = User::findOrFail(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => 'Hesap güncelleme başarılı awk']);
    }
}
