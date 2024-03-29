<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndAlterColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function ($table) {
            $table->longText('image')->change();
        });

        Schema::table('use_cases', function (Blueprint $table) {
            $table->integer('category_id')->default(1);
            //$table->integer('category_id')->default(1)->unsigned()->change();

            //$table->foreign('category_id')->references('id')->on('categories');
        });


        Schema::table('key_ares', function (Blueprint $table) {
            /*$table->foreignId('category_id')->default(1)
                ->constrained('categories_main')
                ->onDelete('restrict');*/
            $table->integer('category_id')->default(1);
           // $table->integer('category_id')->default(1)->unsigned()->change();

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
        Schema::table('portfolios', function ($table) {
            $table->text('image')->change();
        });

        Schema::table('use_cases', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
        Schema::table('key_ares', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }
}
