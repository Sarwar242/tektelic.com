<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearchType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->string('search_type')->default('kea_area');
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('search_type')->default('portfolio');
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('search_type')->default('use_case');
        });
        Schema::table('product_lang', function ($table) {
            $table->string('search_type')->default('catalog');
        });
        Schema::table('products', function ($table) {
            $table->string('search_type')->default('catalog');
        });
        Schema::table('articles', function ($table) {
            $table->string('search_type')->default('articles');
        });
        Schema::table('article_lang', function ($table) {
            $table->string('search_type')->default('articles');
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
            $table->dropColumn('search_type');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });
        Schema::table('product_lang', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });
        Schema::table('article_lang', function (Blueprint $table) {
            $table->dropColumn('search_type');
        });
    }
}
