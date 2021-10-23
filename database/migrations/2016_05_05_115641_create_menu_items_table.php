<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 100);
            $table->string('type', 20)->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('page_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
            $table->integer('depth')->unsigned()->nullable();
            $table->string('pos', 100);
            $table->smallInteger('status')->default();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('menu_item_langs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('lang')->default('en');

            $table->unsignedBigInteger('menu_item_id');
            // $table->foreign('menu_item_id')->references('id')->on('menu_items');
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
        Schema::drop('menu_item_langs');

        Schema::drop('menu_items');
    }
}
