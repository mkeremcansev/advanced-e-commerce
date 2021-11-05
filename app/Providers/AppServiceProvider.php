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
        $campaigns = Campaign::orderBy('id', 'DESC')->get();
        foreach ($campaigns as $campaign) {
            if ($campaign->getCampaignValue->count() == 0) {
                $campaign->status = 0;
                $campaign->save();
            }
        }
        $values = CampaignValue::orderBy('id', 'DESC')->get();
        foreach ($values as $value) {
            $product = Product::where('id', $value->product_id)->first();
            if ($product->status == 0) {
                CampaignValue::where('id', $value->id)->delete();
            }
        }
    }
}
