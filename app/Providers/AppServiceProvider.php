<?php

namespace App\Providers;

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
        $values = CampaignValue::orderBy('id', 'desc')->get();
        foreach ($values as $value) {
            $product = Product::where('id', $value->product_id)->first();
            if ($product->status == 0) {
                CampaignValue::where('id', $value->id)->delete();
            }
        }
    }
}
