<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledPostion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('position');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
}
