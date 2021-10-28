<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Opportunity;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
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
            view()->share('subs', Category::with('children')->orderBy('id', 'ASC')->get());
            view()->share('categorys', Category::where('parent_id', 0)->with('children')->orderBy('id', 'ASC')->get());
            view()->share('members', User::where('status', 0)->orderBy('id', 'DESC')->get());
            view()->share('admins', User::where('status', 1)->orderBy('id', 'DESC')->get());
            view()->share('blockeds', User::where('status', 2)->orderBy('id', 'DESC')->get());
            view()->share('services', Service::orderBy('id', 'DESC')->get());
            view()->share('products', Product::orderBy('id', 'DESC')->get());
            view()->share('brands', Brand::orderBy('id', 'DESC')->get());
            view()->share('opportunitys', Opportunity::orderBy('id', 'DESC')->get());
            view()->share('settings', Setting::where('id', 1)->first());
            view()->share('announcements', Announcement::orderBy('id', 'DESC')->get());
            view()->share('campaigns', Campaign::orderBy('id', 'DESC')->get());
            view()->share('_products', Product::where('status', 1)->get());
            view()->share('_campaigns', Campaign::where('status', 1)->orderBy('id', 'DESC')->get());
            view()->share('_categorys', Category::orderBy('id', 'ASC')->get());
            view()->share('_opportunitys', Opportunity::where('status', 1)->orderBy('id', 'DESC')->get());
            view()->share('_category', Category::where('parent_id', '!=', 0)->inRandomOrder()->limit(4)->get());
        }
    }
}
