<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltTitleTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technologies_lang', function ($table) {
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
        Schema::table('technologies_lang', function ($table) {
            $table->dropColumn('alt');
            $table->dropColumn('pic_title');
        });
    }
}
