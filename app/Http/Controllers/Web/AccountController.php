<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\Verification;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function account()
    {
        $reviews = Review::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('Web.Layouts.Account.account', compact('reviews'));
    }

    public function verify()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->send = true;
        $user->save();
        Mail::to(Auth::user()->email)->send(new Verification(Auth::user()->verification));
        return response()->json(['success' => __('words.verify-email-success')]);
    }

    public function verification($code)
    {
        $user = User::where('verification', $code)->first();
        if ($user && $user->verify == false && $user->id == Auth::user()->id) {
            $user->verify = true;
            $user->verification = Str::random(20);
            $user->save();
            return redirect()->route('Web.Account')->with('success', __('words.verify-success'));
        } else {
            return redirect()->route('Web.Account')->with('error', __('words.verify-error'));
        }
    }
}
