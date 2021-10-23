<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SlidersLang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders_lang', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->string('text');
            $table->bigInteger('slider_id');
          //  $table->unsignedBigInteger('slider_id');
         //   $table->foreign('slider_id')->references('id')->on('slider');
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
        //
    }
}
