<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyIdArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->integer('key_id')->default(0)->nullable();
        });
        Schema::table('use_cases', function (Blueprint $table) {
            $table->integer('key_id')->default(0)->nullable();
        });
        Schema::table('key_ares', function (Blueprint $table) {
            $table->integer('key_id')->default(0)->nullable();
        });
        Schema::table('portfolios', function (Blueprint $table) {
            $table->integer('key_id')->default(0)->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('key_id')->default(0)->nullable();
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
