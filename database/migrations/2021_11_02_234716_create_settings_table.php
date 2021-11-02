<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('keywords');
            $table->longText('description');
            $table->string('adress');
            $table->string('footer');
            $table->longText('map');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('twitter');
            $table->string('mail');
            $table->string('whatsapp');
            $table->string('phone');
            $table->string('logo');
            $table->string('favicon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
