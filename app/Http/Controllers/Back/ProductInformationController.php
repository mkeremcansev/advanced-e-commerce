<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductInformation;

class ProductInformationController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'information' => 'required|array',
                'information.*.title' => 'required|max:255',
                'information.*.description' => 'required|max:255',
            ],
            [
                'information.*.title.required' => __('words.information-title-required'),
                'information.*.title.max' => __('words.information-title-max', ['max' => ':max']),
                'information.*.description.required' => __('words.information-description-required'),
                'information.*.description.max' => __('words.information-description-max', ['max' => ':max']),
            ]
        );
        foreach ($request->information as $info) {
            $information = new ProductInformation;
            $information->product_id = $request->product_id;
            $information->title = $info['title'];
            $information->description = $info['description'];
            $information->save();
        }
        return back()->with('success', __('words.information-success'));
    }
    public function information($id)
    {
        $product = Product::where('id', $id)->first()  ?? abort(404);
        return view('Back.Update.information', compact('product'));
    }
    public function delete($id)
    {
        ProductInformation::where('id', $id)->delete() ?? abort(404);
        return back()->with('success', __('words.information-delete-success'));
    }
}
