<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\CampaignValue;
use App\Models\Opportunity;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Support\Helper;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:5',
                'category_id' => 'required|integer',
                'brand_id' => 'required|integer',
                'description' => 'required|min:5',
                'price' => 'required|integer',
                'discount' => 'required|integer',
                'images' => 'required|array|min:2'
            ],
            [
                'title.required' => __('words.product-required'),
                'title.max' => __('words.product-max', ['max' => ':max']),
                'title.min' => __('words.product-min', ['min' => ':min']),
                'category_id.required' => __('words.product-category-required'),
                'category_id.integer' => __('words.product-category-integer'),
                'brand_id.required' => __('words.product-brand-required'),
                'brand_id.integer' => __('words.product-brand-integer'),
                'description.required' => __('words.product-description-required'),
                'description.min' => __('words.product-description-min', ['min' => ':min']),
                'price.required' => __('words.product-price-required'),
                'price.integer' => __('words.product-price-integer'),
                'discount.required' => __('words.product-discount-required'),
                'discount.integer' => __('words.product-discount-integer'),
                'images.required' => __('words.product-images-required'),
                'images.min' => __('words.product-image-min', ['min' => ':min']),
            ]
        );
        $product = new Product;
        $product->fill($request->all());
        $product->slug = Str::slug($request->title);
        $product->hash = Str::random(30);
        $product->hit = 0;
        $product->status = 0;
        $product->code = thisOneItem($request->title);
        $images = $request->file('images');
        if ($request->hasFile('images')) :
            foreach ($images as $item) :
                $name = Str::random(20) . '.' . $item->extension();
                $item->move(public_path('Product'), $name);
                $arr[] = 'Product' . '/' .  $name;
            endforeach;
            $image = implode(",", $arr);
            $product->images = $image;
        endif;
        $product->save();
        return response()->json(['success' => __('words.product-success'), 'product' => $product->id]);
    }

    public function delete($id)
    {
        $variant = Variant::where('product_id', $id)->count();
        $campaign = CampaignValue::where('product_id', $id)->count();
        $opportunity = Opportunity::where('product_id', $id)->count();
        if ($campaign || $opportunity || $variant) {
            return back()->with('error', __('words.product-value-yes'));
        } else {
            Product::where('id', $id)->delete();
            return back()->with('success', __('words.product-delete-success'));
        }
    }

    public function image(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $array = allItems($product->images);
        $count = count($array);
        if ($count > 2) {
            if (array_search($request->image, $array) !== false) {
                $key = array_search($request->image, $array);
                unset($array[$key]);
                $request->session()->flash('success', __('words.product-image-delete-success'));
            }
        } else {
            $request->session()->flash('error', __('words.product-image-delete-error'));
        }
        $product->images = implode(",", $array);
        $product->save();
        return back();
    }


    public function update($id)
    {
        $product = Product::where('id', $id)->first() ?? abort(404);
        return view('Panel.Update.product', compact('product'));
    }
    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:255|min:5',
                'category_id' => 'required|integer',
                'brand_id' => 'required|integer',
                'description' => 'required|min:5',
                'price' => 'required|integer',
                'discount' => 'required|integer',
                'images' => 'array|min:2',
            ],
            [
                'title.required' => __('words.product-required'),
                'title.max' => __('words.product-max', ['max' => ':max']),
                'title.min' => __('words.product-min', ['min' => ':min']),
                'category_id.required' => __('words.product-category-required'),
                'category_id.integer' => __('words.product-category-integer'),
                'brand_id.required' => __('words.product-brand-required'),
                'brand_id.integer' => __('words.product-brand-integer'),
                'description.required' => __('words.product-description-required'),
                'description.min' => __('words.product-description-min', ['min' => ':min']),
                'price.required' => __('words.product-price-required'),
                'price.integer' => __('words.product-price-integer'),
                'discount.required' => __('words.product-discount-required'),
                'discount.integer' => __('words.product-discount-integer'),
                'images.min' => __('words.product-image-min', ['min' => ':min']),
            ]
        );
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->slug = Str::slug($request->title);
        $product->hash = Str::random(30);
        $variant = Variant::where('product_id', $id)->count();
        if ($variant > 0) {
            $product->status = 1;
        } else {
            $product->status = 0;
        }

        $product->code = thisOneItem($request->title);
        $images = $request->file('images');
        if ($request->hasFile('images')) :
            foreach ($images as $item) :
                $name = Str::random(20) . '.' . $item->extension();
                $item->move(public_path('Product'), $name);
                $arr[] = 'Product' . '/' .  $name;
            endforeach;
            $image = implode(",", $arr);
            $product->images = $image;
        endif;
        $product->save();
        return response()->json(['success' => __('words.product-update-success'), 'product' => $id]);
    }
}
