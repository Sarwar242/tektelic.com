<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubtitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keys_area_lang', function ($table) {
            $table->string('sub_title')->default(null);
        });
        Schema::table('portfolio_lang', function ($table) {
            $table->string('sub_title')->default(null);
        });
        Schema::table('use_cases_lang', function ($table) {
            $table->string('sub_title')->default(null);
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
            $table->dropColumn('sub_title');
        });
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('sub_title');
        });
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->dropColumn('sub_title');
        });
    }
}
