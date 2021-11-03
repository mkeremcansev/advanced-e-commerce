<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewSharePovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            view()->share('subs', Category::with('subCategories')->orderBy('id', 'ASC')->get());
            view()->share('members', User::where('status', 0)->orderBy('id', 'DESC')->get());
            view()->share('admins', User::where('status', 1)->orderBy('id', 'DESC')->get());
            view()->share('blockeds', User::where('status', 2)->orderBy('id', 'DESC')->get());
            view()->share('services', Service::orderBy('id', 'DESC')->get());
            view()->share('products', Product::with(['getCategory', 'getBrand', 'getVariant.getVariantValue'])->orderBy('id', 'DESC')->get());
            view()->share('users', User::orderBy('id', 'DESC')->get());
            view()->share('reviews', Review::orderBy('id', 'DESC')->get());
            view()->share('brands', Brand::orderBy('id', 'DESC')->get());
            view()->share('announcements', Announcement::orderBy('id', 'DESC')->get());
            view()->share('campaigns', Campaign::with('getCampaignValue')->orderBy('id', 'DESC')->get());
            view()->share('_products', Product::with('getProductReviews')->where('status', 1)->orderBy('id', 'DESC')->get()); // Wen new populars
            view()->share('_populars', Product::with('getProductReviews')->where('status', 1)->orderBy('hit', 'DESC')->get()); // web all popular products
            view()->share('_campaigns', Campaign::with('getCampaignValue.getCampaignValueProducts.getProductReviews')->where('status', 1)->orderBy('id', 'DESC')->get()); //Web all campaigns
            view()->share('_categorys', Category::orderBy('id', 'ASC')->get());
            view()->share('_category', Category::with('getCategoryProductIndex')->where('parent_id', '!=', 0)->inRandomOrder()->limit(4)->get()); // Web random category on products
            view()->share('_reviews', Review::with(['getReviewUser', 'getReviewProduct'])->where('status', 1)->orderBy('id', 'DESC')->get()); // active reviews
            view()->share('reviews_', Review::with(['getReviewUser', 'getReviewProduct'])->where('status', 0)->orderBy('id', 'DESC')->get()); // passive reviews
        }
    }
}
