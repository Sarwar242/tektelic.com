<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsFeaturedToUseCasesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_cases_lang', function (Blueprint $table) {
            $table->integer('featured')->nullable();
        });
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->integer('featured')->nullable();
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
            $table->dropColumn('featured');
        });
        Schema::table('keys_area_lang', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
    }
}
