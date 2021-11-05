<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'coupon' => 'required|max:15',
                'discount' => 'required|integer|max:1000000',
            ],
            [
                'coupon.required' => __('words.coupon-code-required'),
                'coupon.max' => __('words.coupon-code-max', ['max' => ':max']),
                'discount.required' => __('words.coupon-discount-required'),
                'discount.integer' => __('words.coupon-discount-integer'),
                'discount.max' => __('words.coupon-discount-max', ['max' => ':max']),
            ]
        );
        $coupon = new Coupon;
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        return response()->json(['success' => __('words.announcement-success')]);
    }

    public function delete($id)
    {
        Coupon::where('id', $id)->delete() ?? abort(404);
        return back()->with('success', __('words.announcement-delete-success'));
    }

    public function update($id)
    {
        $coupon = Coupon::where('id', $id)->firstOrfail();
        return view('Panel.Update.coupon', compact('coupon'));
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'coupon' => 'required|max:15',
                'discount' => 'required|integer|max:1000000',
            ],
            [
                'coupon.required' => __('words.coupon-code-required'),
                'coupon.max' => __('words.coupon-code-max', ['max' => ':max']),
                'discount.required' => __('words.coupon-discount-required'),
                'discount.integer' => __('words.coupon-discount-integer'),
                'discount.max' => __('words.coupon-discount-max', ['max' => ':max']),
            ]
        );
        $coupon = Coupon::findOrFail($id);
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        return response()->json(['success' => __('words.announcement-update-success')]);
    }
}
