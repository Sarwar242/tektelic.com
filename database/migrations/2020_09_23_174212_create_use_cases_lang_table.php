<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseCasesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_cases_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('use_cases_id');
            $table->foreign('use_cases_id')->references('id')->on('use_cases');
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
        Schema::dropIfExists('use_cases_lang');
    }
}
