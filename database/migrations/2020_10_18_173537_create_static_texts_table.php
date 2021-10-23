<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_texts', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('message')->nullable();
            $table->text('data_key');
           // $table->unique(['category', 'data_key']);
            $table->timestamps();
        });

        Schema::create('static_text_langs', function (Blueprint $table) {
            $table->id();
            $table->string('lang');
            $table->text('translation')->nullable;
            $table->unsignedBigInteger('static_text_id');
            $table->foreign('static_text_id')->references('id')->on('static_texts');

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
        Schema::dropIfExists('static_text_langs');
        Schema::dropIfExists('static_texts');
    }
}
