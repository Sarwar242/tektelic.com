<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->longText('image');
            $table->smallInteger('status');
            $table->integer('position')->default(500);
            $table->timestamps();
        });
        Schema::create('benefits_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('benefit_id');
            $table->foreign('benefit_id')->references('id')->on('benefits');
            $table->timestamps();
        });

        Schema::create('quality_lifes', function (Blueprint $table) {
            $table->id();
            $table->longText('image');
            $table->smallInteger('status');
            $table->integer('position')->default(500);
            $table->timestamps();
        });
        Schema::create('quality_lifes_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
             $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('quality_life_id');
            $table->foreign('quality_life_id')->references('id')->on('quality_lifes');
            $table->timestamps();
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->longText('image');
            $table->smallInteger('status');
            $table->integer('position')->default(500);
            $table->timestamps();
        });
        Schema::create('technologies_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
             $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('technology_id');
            $table->foreign('technology_id')->references('id')->on('technologies');
            $table->timestamps();
        });


        Schema::create('use_cases_items_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('use_cases_items_id');

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
        Schema::dropIfExists('tables');
    }
}
