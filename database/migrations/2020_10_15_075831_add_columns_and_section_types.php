<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAndSectionTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_types', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->string('entity_type')->default('benefits');
            $table->string('pos')->default('top');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
