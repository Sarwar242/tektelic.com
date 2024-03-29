<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
//            $table->string('title');
//            $table->text('text');
            $table->smallInteger('status');
            $table->string('image_path');
            $table->string('social_fb');
            $table->string('social_in');
            $table->string('social_li');
            $table->string('social_tv');
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
        Schema::dropIfExists('news');
    }
}
