<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysAreaLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys_area_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('key_ares_id');
            $table->foreign('key_ares_id')->references('id')->on('key_ares');
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
        Schema::dropIfExists('keys_area_lang');
    }
}
