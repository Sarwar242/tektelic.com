<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearchToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_lang', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });

        Schema::table('product_lang', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });

        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });

        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });

        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->longText('search_field')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_lang', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });
        Schema::table('product_lang', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('search_field');
        });

    }
}
