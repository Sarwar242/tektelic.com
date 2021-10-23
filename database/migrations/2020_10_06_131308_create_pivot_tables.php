<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_area_benefit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_area_id')->unsigned();
            $table->integer('benefit_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
        Schema::create('key_area_quality_life', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_area_id')->unsigned();
            $table->integer('quality_life_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('key_area_technology', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key_area_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('use_case_benefit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('use_cases_id')->unsigned();
            $table->integer('benefit_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
        Schema::create('use_case_quality_life', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('use_cases_id')->unsigned();
            $table->integer('quality_life_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::create('use_case_technology', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('use_cases_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('key_area_benefit');
        Schema::dropIfExists('key_area_quality_life');
        Schema::dropIfExists('key_area_technology');
        Schema::dropIfExists('use_case_benefit');
        Schema::dropIfExists('use_case_quality_life');
        Schema::dropIfExists('use_case_technology');
    }
}
