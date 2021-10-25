<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Opportunitys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunitys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('product_id');
            $table->string('slug');
            $table->string('image');
            $table->string('end');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('opportunitys');
    }
}
