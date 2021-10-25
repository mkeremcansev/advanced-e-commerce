<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Support\Helper;

class ServiceController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'color' => 'required|max:30',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => __('words.service-name-required'),
                'name.max' => __('words.service-name-max', ['max' => ':max']),
                'color.required' => __('words.service-color-required'),
                'color.max' => __('words.service-color-max', ['max' => ':max']),
                'image.required' => __('words.service-image-required'),
                'image.mimes' => __('words.service-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.service-image-type'),
            ]
        );
        $service = new Service;
        $service->title = $request->name;
        $service->color = $request->color;
        if ($request->hasFile('image')) {
            $service->image = Helper::imageUpload($request->file('image'), 'Service', $service->image);
        }
        $service->save();
        return response()->json(['success' => __('words.service-success')]);
    }

    public function update($id)
    {
        $service = Service::where('id', $id)->first();
        if ($service) {
            return view('Back.Update.service', compact('service'));
        } else {
            return back();
        }
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'color' => 'required|max:30',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
            ],
            [
                'name.required' => __('words.service-name-required'),
                'name.max' => __('words.service-name-max', ['max' => ':max']),
                'color.required' => __('words.service-color-required'),
                'color.max' => __('words.service-color-max', ['max' => ':max']),
                'image.mimes' => __('words.service-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.service-image-type'),
            ]
        );
        $service = Service::findOrFail($id);
        $service->title = $request->name;
        $service->color = $request->color;
        if ($request->hasFile('image')) {
            $service->image = Helper::imageUpload($request->file('image'), 'Service', $service->image);
        }
        $service->save();
        return response()->json(['success' => __('words.service-update-success')]);
    }

    public function delete($id)
    {
        Service::where('id', $id)->delete();
        return back()->with('success', __('words.service-delete-success'));
    }
}
