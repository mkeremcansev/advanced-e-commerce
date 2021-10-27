<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VariantValue;
use Illuminate\Support\Str;

class VariantController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:15',
                'product_id' => 'required|integer',
                'variant' => 'required|array',
                'variant.*.option_title' => 'required|max:15',
                'variant.*.option_stock' => 'required|integer',
                'variant.*.option_price' => 'required|integer',
            ],
            [
                'title.required' => __('words.variant-required'),
                'title.max' => __('words.variant-max', ['max' => ':max']),
                'product_id.required' => __('words.variant-product_id-required'),
                'product_id.integer' => __('words.variant-product_id-integer'),
                'variant.*.option_title.required' => __('words.variant-title-required'),
                'variant.*.option_title.max' => __('words.variant-option-title', ['max' => ':max']),
                'variant.*.option_stock.required' => __('words.variant-option_stock-required'),
                'variant.*.option_stock.integer' => __('words.variant-option_stock-integer'),
                'variant.*.option_price.required' => __('words.variant-option_price-required'),
                'variant.*.option_price.integer' => __('words.variant-option_price-integer'),
            ]
        );
        Variant::where('product_id', $request->product_id)->count();
        $variant = new Variant;
        $variant->title = $request->title;
        $variant->product_id = $request->product_id;
        $variant->save();

        foreach ($request->variant as $data) {
            $value = new VariantValue;
            $value->product_id = $request->product_id;
            $value->variant_id = $variant->id;
            $value->hash = Str::random(30);
            $value->title = $data['option_title'];
            $value->stock = $data['option_stock'];
            $value->price = $data['option_price'];
            $value->save();
        }
        $product = Product::where('id', $request->product_id)->first() ?? abort(404);
        $product->status = 1;
        $product->save();
        return back()->with('success', __('words.variation-success'));
    }
    public function variant($id)
    {
        $product = Product::where('id', $id)->first()  ?? abort(404);
        return view('Panel.Update.variant', compact('product'));
    }
    public function delete($id)
    {
        $value = VariantValue::where('id', $id)->first() ?? abort(404);
        $data = VariantValue::where('variant_id', $value->variant_id)->count();
        if ($data == 1) {
            Variant::where('id', $value->variant_id)->delete();
            VariantValue::where('id', $id)->delete();
            $products = VariantValue::where('product_id', $value->product_id)->count();
            if ($products < 1) {
                $product = Product::where('id', $value->product_id)->first() ?? abort(404);
                $product->status = 0;
                $product->save();
            }
            return back()->with('success', __('words.variant-delete-success'));
        } else {
            VariantValue::where('id', $id)->delete();
            return back()->with('success', __('words.variant-delete-success'));
        }
    }
    public function update($id)
    {
        $value = VariantValue::where('id', $id)->first() ?? abort(404);
        return view('Panel.Update.value', compact('value'));
    }
    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:15',
                'option_title' => 'required|max:15',
                'option_stock' => 'required|integer',
                'option_price' => 'required|integer',
            ],
            [
                'title.required' => __('words.variant-required'),
                'title.max' => __('words.variant-max', ['max' => ':max']),
                'option_title.required' => __('words.variant-title-required'),
                'option_title.max' => __('words.variant-option-title', ['max' => ':max']),
                'option_stock.required' => __('words.variant-option_stock-required'),
                'option_stock.integer' => __('words.variant-option_stock-integer'),
                'option_price.required' => __('words.variant-option_price-required'),
                'option_price.integer' => __('words.variant-option_price-integer'),
            ]
        );
        $value = VariantValue::where('id', $id)->first() ?? abort(404);
        $value->title = $request->option_title;
        $value->stock = $request->option_stock;
        $value->price = $request->option_price;
        $variant = Variant::where('id', $value->variant_id)->first()  ?? abort(404);
        $variant->title = $request->title;
        $variant->save();
        $value->save();
        return response()->json(['success' => __('words.variation-update-success')]);
    }
}
