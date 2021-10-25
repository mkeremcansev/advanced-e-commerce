<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CampaignValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_values', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_id');
            $table->string('product_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('campaign_values');
    }
}
