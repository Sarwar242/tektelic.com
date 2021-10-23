<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductFieldsAlter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('subtitle')->nullable()->change();
            $table->text('protection')->nullable()->change();
            $table->text('weight')->nullable()->change();
            $table->text('size')->nullable()->change();
            $table->text('op_temp')->nullable()->change();
            $table->text('text')->nullable()->change();
           // $table->text('images')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('subtitle')->nullable()->change();
            $table->text('protection')->nullable()->change();
            $table->text('weight')->nullable()->change();
            $table->text('size')->nullable()->change();
            $table->text('op_temp')->nullable()->change();
            $table->text('text')->nullable()->change();
            // $table->text('images')->nullable()->change();
        });
    }
}
