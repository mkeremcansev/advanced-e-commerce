<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Services extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color');
            $table->string('image');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('service');
    }
}
