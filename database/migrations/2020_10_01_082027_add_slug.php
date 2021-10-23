<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->string('slug')->default(rand(5, 100))->unique();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('slug')->default(rand(4, 200))->unique();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('slug')->default(rand(2, 300))->unique();
        });
        Schema::table('product_lang', function ($table) {
            $table->string('slug')->unique();
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
            $table->dropColumn('slug');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('product_lang', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
