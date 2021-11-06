<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'coupon' => 'required',
            ],
            [
                'coupon.required' => __('words.coupon-code-required'),
            ]
        );
        $coupon = Coupon::where('coupon', $request->coupon)->where('status', 1)->first();
        if ($coupon && !Session::get('coupon')) {
            $request->session()->put('coupon', $coupon->discount);
            $coupon->status = 0;
            $coupon->save();
            return back()->with('success', __('words.discount-success'));
        } else {
            return back()->with('error', __('words.discount-error'));
        }
    }
}
