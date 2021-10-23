<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->longText('text')->change();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->longText('text')->change();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->longText('text')->change();
        });
        Schema::table('product_lang', function ($table) {
            $table->longText('text')->change();
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
            $table->string('text')->change();
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('text')->change();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('text')->change();
        });
        Schema::table('product_lang', function ($table) {
            $table->string('text')->change();
        });
    }
}
