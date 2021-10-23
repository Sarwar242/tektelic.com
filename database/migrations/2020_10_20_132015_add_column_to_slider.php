<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('button_text')->nullable();
        });
        Schema::table('sliders_lang', function (Blueprint $table) {
            $table->string('button_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('button_text');
        });
        Schema::table('sliders_lang', function (Blueprint $table) {
            $table->dropColumn('button_text');
        });
    }
}
