<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_lang', function ($table) {
            $table->longText('text')->nullable()->change();
            $table->text('sub_title')->nullable()->change();
            $table->text('sub_title2')->nullable()->change();
            $table->text('text2')->nullable()->change();
            $table->text('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
        });

        Schema::table('keys_area_lang', function ($table) {
            $table->longText('text')->nullable()->change();
            $table->text('sub_title')->nullable()->change();
            $table->text('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->longText('text')->nullable()->change();
            $table->text('sub_title')->nullable()->change();
            $table->text('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
