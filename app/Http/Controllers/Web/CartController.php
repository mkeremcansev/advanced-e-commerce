<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantValue;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'data' => 'required',
                'product' => 'required',
                'quantity' => 'required|integer|min:1',
            ],
            [
                'data.required' => __('words.cart-product-selected'),
                'product.required' => __('words.cart-product-required'),
                'quantity.required' => __('words.cart-quantity-required'),
                'quantity.integer' => __('words.cart-quantity-integer'),
                'quantity.min' => __('words.cart-quantity-min', ['min' => ':min']),
            ]
        );
        $product = Product::where('hash', $request->product)->first();
        $variantValue = Variant::where('product_id', $product->id)->count();
        $requestData = count($request->data);
        if ($variantValue != $requestData) {
            return response()->json(['message' => 0]);
        } else {
            if ($product->discount != 0) {
                $price = $product->discount;
            } else {
                $price = $product->price;
            }
            $newArray = [];
            $newKeys  = [];
            foreach ($request->data as $variant) {
                $value = VariantValue::where('hash', $variant)->first() ?? abort(404);
                if ($value->price != 0) {
                    $price = $price + $value->price;
                }
                array_push($newArray, $value->title);
                array_push($newKeys, $value->getVariantMain->title);
            }
            $options = array_combine($newKeys, $newArray);
            Cart::instance('cart')->add([
                'id' => $product->id,
                'name' => $product->title,
                'price' => $price,
                'qty' => $request->quantity,
                'options' => $options
            ])->associate('App\Models\Product');
            return response()->json([
                'message' => $request->data,
                'product' => $request->product,
                'quantity' => $request->quantity,
                'cart' => Cart::instance('cart')->content()->count()
            ]);
        }
    }

    public function put($id, Request $request)
    {
        $request->validate(
            [
                'quantity' => 'required|integer',
            ],
            [
                'quantity.required' => __('words.cart-quantity-required'),
                'quantity.integer' => __('words.cart-quantity-integer')
            ]
        );
        $cart = Cart::instance('cart')->update($id, $request->quantity);
        $price = $cart->price * $cart->qty;
        return response()->json([
            'message' => __('words.cart-update-success'),
            'id' => $cart->rowId,
            'total' => replaceFormat(Cart::instance('cart')->total()),
            'subtotal' => replaceFormat(Cart::instance('cart')->subtotal()),
            'tax' => replaceFormat(Cart::instance('cart')->tax()),
            'qty' => $cart->qty,
            'price' => priceToFormat($price),
        ]);
    }

    public function delete($id)
    {
        Cart::instance('cart')->remove($id);
        return back()->with('success', __('words.cart-product-delete-success'));
    }

    public function destroy()
    {
        Cart::instance('cart')->destroy();
        return back()->with('success', __('words.cart-destroy-success'));
    }
}
