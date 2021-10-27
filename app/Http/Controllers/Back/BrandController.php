<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Support\Helper;

class BrandController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => __('words.brand-name-required'),
                'name.max' => __('words.brand-name-max', ['max' => ':max']),
                'image.required' => __('words.brand-image-required'),
                'image.mimes' => __('words.brand-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.brand-image-type'),
            ]
        );
        $brand = new Brand;
        $brand->title = $request->name;
        if ($request->hasFile('image')) {
            $brand->image = Helper::imageUpload($request->file('image'), 'Brand', $brand->image);
        }
        $brand->save();
        return response()->json(['success' => __('words.brand-success')]);
    }

    public function update($id)
    {
        $brand = Brand::where('id', $id)->first();
        if ($brand) {
            return view('Panel.Update.brand', compact('brand'));
        } else {
            return back();
        }
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => __('words.brand-name-required'),
                'name.max' => __('words.brand-name-max', ['max' => ':max']),
                'image.mimes' => __('words.brand-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.brand-image-type'),
            ]
        );
        $brand = Brand::findOrFail($id);
        $brand->title = $request->name;
        if ($request->hasFile('image')) {
            $brand->image = Helper::imageUpload($request->file('image'), 'Brand', $brand->image);
        }
        $brand->save();
        return response()->json(['success' => __('words.brand-update-success')]);
    }

    public function delete($id)
    {
        $brand = Brand::where('id', $id)->first();
        $product = Product::where('brand_id', $brand->id)->count();
        if ($product) {
            return back()->with('error', __('words.brand-product-error'));
        } else {
            Brand::where('id', $id)->delete();
            return back()->with('success', __('words.brand-delete-success'));
        }
    }
}
