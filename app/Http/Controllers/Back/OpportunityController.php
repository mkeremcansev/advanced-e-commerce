<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Support\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OpportunityController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:30',
                'product_id' => 'required|integer',
                'end' => 'required|date',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => __('words.opportunity-name-required'),
                'title.max' => __('words.opportunity-name-max', ['max' => ':max']),
                'product_id.required' => __('words.opportunity-color-required'),
                'product_id.max' => __('words.opportunity-product_id-integer'),
                'end.required' => __('words.opportunity-end-required'),
                'end.date' => __('words.opportunity-end-date'),
                'image.required' => __('words.opportunity-image-required'),
                'image.mimes' => __('words.opportunity-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.opportunity-image-type'),
            ]
        );
        $opportunity = new Opportunity;
        $opportunity->title = $request->title;
        $opportunity->product_id = $request->product_id;
        $opportunity->slug = Str::slug($request->title);
        $opportunity->end = $request->end;
        if ($request->hasFile('image')) {
            $opportunity->image = Helper::imageUpload($request->file('image'), 'Opportunity', $opportunity->image);
        }
        $opportunity->save();
        return response()->json(['success' => __('words.opportunity-success')]);
    }

    public function update($id)
    {
        $opportunity = Opportunity::where('id', $id)->first() ?? abort(404);
        return view('Panel.Update.opportunity', compact('opportunity'));
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:30',
                'product_id' => 'required|max:30',
                'end' => 'required|date',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => __('words.opportunity-name-required'),
                'title.max' => __('words.opportunity-name-max', ['max' => ':max']),
                'product_id.required' => __('words.opportunity-color-required'),
                'product_id.max' => __('words.opportunity-product_id-integer'),
                'end.required' => __('words.opportunity-end-required'),
                'end.date' => __('words.opportunity-end-date'),
                'image.mimes' => __('words.opportunity-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.opportunity-image-type'),
            ]
        );
        $opportunity = Opportunity::findOrFail($id);
        $opportunity->title = $request->title;
        $opportunity->product_id = $request->product_id;
        $opportunity->slug = Str::slug($request->title);
        $opportunity->end = $request->end;
        $opportunity->status = 1;
        if ($request->hasFile('image')) {
            $opportunity->image = Helper::imageUpload($request->file('image'), 'Opportunity', $opportunity->image);
        }
        $opportunity->save();
        return response()->json(['success' => __('words.opportunity-update-success')]);
    }

    public function delete($id)
    {
        Opportunity::where('id', $id)->delete() ?? abort(404);
        return back()->with('success', __('words.opportunity-delete-success'));
    }
}
