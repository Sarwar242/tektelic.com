<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('image');
            $table->smallInteger('status');
            $table->integer('position')->default(500);
            $table->timestamps();
        });

        Schema::create('countries_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
           // $table->longText('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });


        Schema::table('distributors', function (Blueprint $table) {
            $table->integer('country_id');
            $table->text('link');
            // $table->longText('section_text')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_lang');
        Schema::dropIfExists('countries');

        Schema::table('distributors', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('link');
        });
    }
}
