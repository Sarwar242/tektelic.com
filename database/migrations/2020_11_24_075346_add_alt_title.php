<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('product_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('products', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('articles', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
        Schema::table('article_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });

        Schema::table('distributors_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });

        Schema::table('pages', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });

        Schema::table('page_lang', function ($table) {
            $table->string('alt')->nullable();
            $table->string('pic_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('product_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('products', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('articles', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
        Schema::table('article_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });

        Schema::table('distributors_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });

        Schema::table('pages', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });

        Schema::table('page_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
    }
}
