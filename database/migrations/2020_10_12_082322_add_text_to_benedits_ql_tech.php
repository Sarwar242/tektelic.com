<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextToBeneditsQlTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('benefits_lang', function (Blueprint $table) {
            $table->longText('text')->default(null)->change();
           // $table->longText('section_text')->default(null);
        });

        Schema::table('quality_lifes_lang', function (Blueprint $table) {
            $table->longText('text')->default(null)->change();
           // $table->longText('section_text')->default(null);
        });

        Schema::table('technologies_lang', function (Blueprint $table) {
            $table->longText('text')->default(null)->change();
            //$table->longText('section_text')->default(null);
        });

        Schema::table('benefits', function (Blueprint $table) {
            $table->string('image')->default(null)->change();
        });

        Schema::table('quality_lifes', function (Blueprint $table) {
            $table->string('image')->default(null)->change();
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->string('image')->default(null)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /* Schema::table('benefits_lang', function (Blueprint $table) {
            $table->dropColumn('text');
        });
        Schema::table('quality_lifes_lang', function (Blueprint $table) {
            $table->dropColumn('text');
        });
        Schema::table('technologies_lang', function (Blueprint $table) {
            $table->dropColumn('text');
        });*/
    }
}
