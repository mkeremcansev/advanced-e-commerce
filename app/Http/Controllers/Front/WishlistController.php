<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'product' => 'required',
            ],
            [
                'product.required' => __('words.cart-product-required'),
            ]
        );
        $product = Product::where('hash', $request->product)->first();
        if ($product->discount != 0) {
            $price = $product->discount;
        } else {
            $price = $product->price;
        }
        Cart::instance('wishlist')->add($product->id, $product->title, 1, $price)->associate('App\Models\Product');
        return response()->json([
            'message' => __('words.wishlist-add-success'),
            'wishlist' => Cart::instance('wishlist')->content()->count()
        ]);
    }
    public function delete($id)
    {
        Cart::instance('wishlist')->remove($id);
        return back()->with('success', __('words.cart-product-delete-success'));
    }
}
