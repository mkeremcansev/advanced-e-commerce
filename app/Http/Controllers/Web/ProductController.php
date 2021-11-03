<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function single($slug)
    {
        $single = Product::where('slug', $slug)->where('status', 1)->with(['getProductReviews.getReviewUser', 'getVariant.getVariantValue', 'getBrand', 'getBrand'])->firstOrFail();
        $single->increment('hit', 1);
        $single->save();
        return view('Web.Layouts.main-single', compact('single'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->where('status', 1)->with('getProductReviews')->paginate(4)->onEachSide(0);
        return view('Web.Layouts.main-category-products', ['products' => $products, 'category' => $category->title]);
    }

    public function campaign($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        $values = CampaignValue::where('campaign_id', $campaign->id)->with('getCampaignValueProducts.getProductReviews')->paginate(4)->onEachSide(0);
        return view('Web.Layouts.main-campaign-products', ['values' => $values, 'campaign' => $campaign]);
    }
}
