<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdTo2tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_cases', function (Blueprint $table) {
            $table->integer('product_id')->default(1);
            //$table->integer('category_id')->default(1)->unsigned()->change();

            //$table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::table('key_ares', function (Blueprint $table) {
            $table->integer('product_id')->default(1);
            //$table->integer('category_id')->default(1)->unsigned()->change();

            //$table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_cases', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
        Schema::table('key_ares', function (Blueprint $table) {
            $table->dropColumn('product_id');
        });
    }
}
