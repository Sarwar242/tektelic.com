<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function ($table) {
        $table->string('subtitle')->nullable()->change();
        $table->string('seo_title')->nullable()->change();
        $table->string('seo_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->change();
            $table->string('seo_title')->nullable()->change();
            $table->string('seo_description')->nullable()->change();
        });
    }
}
