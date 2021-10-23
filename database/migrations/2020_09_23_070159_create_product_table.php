<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
//            $table->string('title');
//            $table->string('subtitle');
//            $table->text('text');
            $table->smallInteger('status');
            $table->integer('type');
            $table->integer('price');
            $table->string('op_temp');
            $table->string('protection');
            $table->string('weight');
            $table->text('size');
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
