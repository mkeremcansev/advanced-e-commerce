<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function status($id)
    {
        $review = Review::where('id', $id)->firstOrfail();
        if ($review->status == true) {
            $review->status = false;
        } else {
            $review->status = true;
        }
        $review->save();
        return back()->with('success', __('words.review-status-success'));
    }
}
