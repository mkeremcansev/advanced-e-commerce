<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single($slug)
    {
        $single = Product::where('slug', $slug)->first() ?? abort(404);
        $single->increment('hit', 1);
        $single->save();
        return view('Web.single', compact('single'));
    }
}