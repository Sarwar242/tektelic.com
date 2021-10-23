<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: use JSON data type for 'extras' instead of string
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template');

            $table->integer('status');
            $table->string('name');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');
            $table->text('content')->nullable();
            $table->text('extras')->nullable();
            $table->text('image')->nullable();

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('page_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->longText('text')->nullable();
            $table->string('slug');
            $table->string('lang')->default('en');

            $table->text('h1')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_robots')->nullable();
            $table->text('meta_keys')->nullable();
            $table->text('canonical')->nullable();

            $table->unsignedBigInteger('page_id');
           // $table->foreign('page_id')->references('id')->on('pages');
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
        Schema::drop('page_lang');

        Schema::drop('pages');
    }
}
