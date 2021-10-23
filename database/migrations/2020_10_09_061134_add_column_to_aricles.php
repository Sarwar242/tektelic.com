<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAricles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropColumn('article_id');
            $table->string('articles_id');
            $table->string('subtitle')->nullable();
        });
        Schema::table('article_lang', function (Blueprint $table) {
            $table->string('subtitle')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aricles', function (Blueprint $table) {
            //
        });
    }
}
