<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBgText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->string('bg_text')->nullable();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('bg_text')->nullable();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('bg_text')->nullable();
        });
        Schema::table('product_lang', function ($table) {
            $table->string('bg_text')->nullable();
        });

        Schema::table('article_lang', function ($table) {
            $table->string('bg_text')->nullable();
        });

        Schema::table('articles', function ($table) {
            $table->string('bg_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });
        Schema::table('product_lang', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });

        Schema::table('article_lang', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('bg_text');
        });
    }
}
