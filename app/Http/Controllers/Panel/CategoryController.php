<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Support\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'main' => 'required|max:40',
                'name' => 'required|max:40',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'main.required' => __('words.main-category-required'),
                'main.max' => __('words.main-category-max', ['max' => ':max']),
                'name.required' => __('words.category-required'),
                'name.max' => __('words.category-max', ['max' => ':max']),
                'image.required' => __('words.category-image-required'),
                'image.mimes' => __('words.category-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.category-image-type'),
            ]
        );
        $category = new Category;
        $category->parent_id = $request->main;
        $category->title = $request->name;
        $category->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $category->image = Helper::imageUpload($request->file('image'), 'Category', $category->image);
        }
        $category->save();
        return response()->json(['success' => __('words.category-success')]);
    }

    public function update($id)
    {
        $category = Category::where('id', $id)->first() ?? abort(404);
        if ($category) {
            return view('Panel.Update.category', compact('category'));
        } else {
            return back();
        }
    }
    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'main' => 'required|max:40',
                'name' => 'required|max:40',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
            ],
            [
                'main.required' => __('words.main-category-required'),
                'main.max' => __('words.main-category-max', ['max' => ':max']),
                'name.required' => __('words.category-required'),
                'name.max' => __('words.category-max', ['max' => ':max']),
                'image.mimes' => __('words.category-image-mimes', ['mimes' => ':values']),
            ]
        );

        $category = Category::findOrFail($id);
        $category->parent_id = $request->main;
        $category->title = $request->name;
        $category->slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $category->image = Helper::imageUpload($request->file('image'), 'Category', $category->image);
        }
        $category->save();
        return response()->json(['success' => __('words.category-update-success')]);
    }

    public function delete($id)
    {
        $requestCategory = Category::where('id', $id)->first() ?? abort(404);
        $parentCategory = Category::where('parent_id', $requestCategory->id)->count();
        $product = Product::where('category_id', $id)->count();
        if ($parentCategory) {
            return back()->with('error', __('words.category-error-message'));
        } elseif ($product) {
            return back()->with('error', __('words.category-product-error'));
        } else {
            Category::where('id', $id)->delete();
            return back()->with('success', __('words.category-delete-success'));
        }
    }
}
