<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\Helper;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function put(Request $request)
    {
        $fill = $request->validate(
            [
                'title' => 'required|min:3|max:20',
                'description' => 'required|min:10|max:250',
                'footer' => 'required|min:5|max:50',
                'keywords' => 'required|min:5|max:1000',
                'adress' => 'required|min:5|max:150',
                'map' => 'required|min:10|max:500',
                'facebook' => 'required|min:10|max:100',
                'instagram' => 'required|min:10|max:100',
                'twitter' => 'required|min:10|max:100',
                'mail' => 'required|min:10|max:100',
                'whatsapp' => 'required|min:10|max:13',
                'phone' => 'required|min:10|max:13',
                'logo' => 'mimes:jpeg,png,jpg,svg|max:4096',
                'favicon' => 'mimes:ico|max:2048',
            ],
            [
                'title.required' => __('words.setting-title-required'),
                'title.min' => __('words.setting-title-min', ['min' => ':min']),
                'title.max' => __('words.setting-title-max', ['max' => ':max']),

                'description.required' => __('words.description-required'),
                'description.min' => __('words.description-min', ['min' => ':min']),
                'description.max' => __('words.description-max', ['max' => ':max']),

                'footer.required' => __('words.footer-required'),
                'footer.min' => __('words.footer-min', ['min' => ':min']),
                'footer.max' => __('words.footer-max', ['max' => ':max']),
                'keywords.required' => __('words.keywords-required'),
                'keywords.min' => __('words.keywords-min', ['min' => ':min']),
                'keywords.max' => __('words.keywords-max', ['max' => ':max']),

                'adress.required' => __('words.adress-required'),
                'adress.min' => __('words.adress-min', ['min' => ':min']),
                'adress.max' => __('words.adress-max', ['max' => ':max']),

                'map.required' => __('words.map-required'),
                'map.min' => __('words.map-min', ['min' => ':min']),
                'map.max' => __('words.map-max', ['max' => ':max']),
                'facebook.required' => __('words.facebook-required'),
                'facebook.min' => __('words.facebook-min', ['min' => ':min']),
                'facebook.max' => __('words.facebook-max', ['max' => ':max']),
                'instagram.required' => __('words.instagram-required'),
                'instagram.min' => __('words.instagram-min', ['min' => ':min']),
                'instagram.max' => __('words.instagram-max', ['max' => ':max']),
                'twitter.required' => __('words.twitter-required'),
                'twitter.min' => __('words.twitter-min', ['min' => ':min']),
                'twitter.max' => __('words.twitter-max', ['max' => ':max']),
                'mail.required' => __('words.mail-required'),
                'mail.min' => __('words.mail-min', ['min' => ':min']),
                'mail.max' => __('words.mail-max', ['max' => ':max']),
                'whatsapp.required' => __('words.whatsapp-required'),
                'whatsapp.min' => __('words.whatsapp-min', ['min' => ':min']),
                'whatsapp.max' => __('words.whatsapp-max', ['max' => ':max']),
                'phone.required' => __('words.whatsapp-required'),
                'phone.min' => __('words.phone-min', ['min' => ':min']),
                'phone.max' => __('words.phone-max', ['max' => ':max']),
                'logo.mimes' => __('words.logo-type', ['type' => ':values']),
                'logo.max' => __('words.logo-max', ['max' => ':max']),
                'favicon.mimes' => __('words.favicon-type', ['type' => ':values']),
                'favicon.max' => __('words.favicon-max', ['max' => ':max']),
                'logo.mimes' => __('words.logo-type', ['type' => ':values']),
                'logo.max' => __('words.logo-max', ['max' => ':max']),
                'favicon.mimes' => __('words.favicon-type', ['type' => ':values']),
                'favicon.max' => __('words.favicon-max', ['max' => ':max']),
            ]
        );
        $setting = Setting::findOrFail(1);
        $setting->fill($fill);
        if ($request->hasFile('logo')) {
            $setting->logo = Helper::imageUpload($request->file('logo'), 'Logo', $setting->logo);
        }
        if ($request->hasFile('favicon')) {
            $setting->favicon = Helper::imageUpload($request->file('favicon'), 'Favicon', $setting->favicon);
        }
        $setting->save();
        return back()->with('success', __('words.setting-success-message'));
    }
}
