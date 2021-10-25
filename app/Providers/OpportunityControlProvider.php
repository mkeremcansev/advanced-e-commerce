<?php

namespace App\Providers;

use App\Models\Opportunity;
use Illuminate\Support\ServiceProvider;

class OpportunityControlProvider extends ServiceProvider
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
            $opportunitys = Opportunity::all();
            foreach ($opportunitys as $opportunity) {
                $date = str_replace('.', '-', date('Y.m.d H:i'));
                if ($opportunity->end == $date || $opportunity->end < $date) {
                    $opportunity->status = 0;
                    $opportunity->save();
                } elseif ($opportunity->getOpportunityProduct->status == 0) {
                    $opportunity->status = 0;
                    $opportunity->save();
                }
            }
        }
    }
}
