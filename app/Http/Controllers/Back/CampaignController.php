<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignValue;
use Illuminate\Http\Request;
use App\Support\Helper;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:30',
                'image' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => __('words.campaign-name-required'),
                'title.max' => __('words.campaign-name-max', ['max' => ':max']),
                'image.required' => __('words.campaign-image-required'),
                'image.mimes' => __('words.campaign-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.campaign-image-type'),
            ]
        );
        $campaign = new Campaign;
        $campaign->title = $request->title;
        $campaign->slug = Str::slug($request->title);
        if ($request->hasFile('image')) {
            $campaign->image = Helper::imageUpload($request->file('image'), 'Campaign', $campaign->image);
        }
        $campaign->save();
        return response()->json(['success' => __('words.campaign-add-success'), 'campaign' => $campaign->id]);
    }
    public function value($id)
    {
        $campaign = Campaign::where('id', $id)->first()  ?? abort(404);
        return view('Panel.Update.campaign', compact('campaign'));
    }

    public function campaign(Request $request)
    {
        $request->validate(
            [
                'products' => 'required|array',
                'campaign_id' => 'required|integer',
            ],
            [
                'products.required' => __('words.campaign-product-required'),
                'campaign_id.required' => __('words.campaign-id-required'),
                'campaign_id.integer' => __('words.campaign-id-integer'),
            ]
        );
        foreach ($request->products as $product) {
            $campaignValue = new CampaignValue;
            $campaign = Campaign::where('id', $request->campaign_id)->first() ?? abort(404);
            $campaign->status = 1;
            $campaign->save();
            $campaignValue->campaign_id = $request->campaign_id;
            $campaignValue->product_id = $product;
            $campaignValue->save();
        }
        return back()->with('success', __('words.campaign-product-add-success'));
    }

    public function update($id)
    {
        $campaign = Campaign::where('id', $id)->first() ?? abort(404);
        return view('Panel.Update.campaigns', compact('campaign'));
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:30',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
            ],
            [
                'title.required' => __('words.campaign-name-required'),
                'title.max' => __('words.campaign-name-max', ['max' => ':max']),
                'image.mimes' => __('words.campaign-image-mimes', ['mimes' => ':values']),
                'image.image' => __('words.campaign-image-type'),
            ]
        );
        $campaign = Campaign::findOrFail($id);
        $campaign->title = $request->title;
        if ($request->hasFile('image')) {
            $campaign->image = Helper::imageUpload($request->file('image'), 'Campaign', $campaign->image);
        }
        $campaign->save();
        return response()->json(['success' => __('words.campaign-update-success'), 'campaign' => $campaign->id]);
    }

    public function status($id, $status)
    {
        $campaign = Campaign::where('id', $id)->first() ?? abort(404);
        $campaignValue = CampaignValue::where('campaign_id', $campaign->id)->count();
        if (!$campaignValue && $status == 1) {
            return back()->with('error', __('words.campaign-not-product'));
        } else {
            $campaign->status = $status;
            $campaign->save();
            return back()->with('success', __('words.campaign-status-success'));
        }
    }

    public function delete($id)
    {
        $campaign = Campaign::where('id', $id)->first() ?? abort(404);
        $campaignValue = CampaignValue::where('campaign_id', $campaign->id)->count();
        if ($campaignValue) {
            return back()->with('error', __('words.campaign-yes-product'));
        } else {
            $campaign->delete();
            return back()->with('success', __('words.campaign-delete-success'));
        }
    }

    public function vdelete($id)
    {
        $campaignValue = CampaignValue::where('id', $id)->first() ?? abort(404);
        $campaignValueCount = CampaignValue::where('campaign_id', $campaignValue->campaign_id)->count();
        if ($campaignValueCount == 1) {
            $campaign = Campaign::where('id', $campaignValue->campaign_id)->first() ?? abort(404);
            $campaign->status = 0;
            $campaign->save();
            $campaignValue->delete();
            return back()->with('success', __('words.campaign-product-delete-success'));
        } else {
            $campaignValue->delete();
            return back()->with('success', __('words.campaign-product-delete-success'));
        }
    }
}
