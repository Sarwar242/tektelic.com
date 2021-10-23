<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('status')->default(1);
            $table->string('title')->nullable();
            $table->string('value')->nullable();
            $table->string('type')->default('phone');
            $table->integer('position')->default(500);
            $table->timestamps();
        });
        Schema::create('contacts_lang', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('text');
            $table->string('lang')->default('en');
            $table->unsignedBigInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts');
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
        Schema::dropIfExists('contacts');
    }
}
