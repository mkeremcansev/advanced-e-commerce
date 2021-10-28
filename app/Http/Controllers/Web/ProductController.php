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
        return view('Web.Layouts.main-single', compact('single'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first() ?? abort(404);
        $products = Product::where('category_id', $category->id)->paginate(12)->onEachSide(0);
        return view('Web.Layouts.main-category-products', ['products' => $products, 'category' => $category->title]);
    }
}
