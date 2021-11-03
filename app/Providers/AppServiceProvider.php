<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\CampaignValue;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Campaign control
        $campaigns = Campaign::orderBy('id', 'desc')->get();
        foreach ($campaigns as $campaign) {
            if ($campaign->getCampaignValue->count() == false) {
                $campaign->status = false;
                $campaign->save();
            }
        }
        // Campaign value control
        $values = CampaignValue::orderBy('id', 'desc')->get();
        foreach ($values as $value) {
            $product = Product::where('id', $value->product_id)->first();
            if ($product->status == false) {
                CampaignValue::where('id', $value->id)->delete();
            }
        }
    }
}
