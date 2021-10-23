<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('seo_title');
            $table->text('seo_description');

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });

        Schema::table('article_lang', function (Blueprint $table) {
            $table->text('seo_title');
            $table->text('seo_description');

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('seo_title');
            $table->text('seo_description');

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });

        Schema::table('product_lang', function (Blueprint $table) {
            $table->text('seo_title');
            $table->text('seo_description');

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });


        Schema::table('keys_area_lang', function ($table) {
            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();
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
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });


        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });

        Schema::table('article_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });

        Schema::table('product_lang', function (Blueprint $table) {
            $table->dropColumn('h1');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_robots');
            $table->dropColumn('meta_keys');
            $table->dropColumn('canonical');
        });
    }
}
