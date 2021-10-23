<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_datas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::table('home_datas')->insert(
            array(
                array(
                    'slug' => 'use_case',
                    'description' => NULL
                ),
                array(
                    'slug' => 'key_areas',
                    'description' => NULL
                ),
                array(
                    'slug' => 'case_studies',
                    'description' => NULL
                ),
                array(
                    'slug' => 'products',
                    'description' => NULL
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_data');
    }
}
