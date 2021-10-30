<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'product' => 'required',
                'rating' => 'required',
                'review' => 'required|min:50|max:250'
            ],
            [
                'product.required' => __('words.review-product-required'),
                'rating.required' => __('words.review-rating-required'),
                'review.required' => __('words.review-review-required'),
                'review.min' => __('words.review-review-min', ['min' => ':min']),
                'review.max' => __('words.review-review-max', ['max' => ':max']),
            ]
        );

        $product = Product::where('hash', $request->product)->first();
        $control = Review::where('user_id', Auth::user()->id)->where('product_id', $product->id)->count();
        if ($control) {
            return response()->json(['status' => 201, 'message' => __('words.review-user-not-success')]);
        } else {
            $review = new Review;
            $review->product_id = $product->id;
            $review->user_id = Auth::user()->id;
            $review->title = $request->review;
            $review->rating = $request->rating;
            $review->save();
            return response()->json(['status' => 200, 'message' => __('words.review-add-success')]);
        }
    }
}
