<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->timestamps();
        });
        DB::table('headings')->insert(
            array(
                array(
                    'slug' => 'products',
                    'title' => NULL
                ),
                array(
                    'slug' => 'success_stories',
                    'title' => NULL
                ),
                array(
                    'slug' => 'use_cases',
                    'title' => NULL
                ),
                array(
                    'slug' => 'key_areas',
                    'title' => NULL
                ),
                array(
                    'slug' => 'knowledge_base',
                    'title' => NULL
                ),
                array(
                    'slug' => 'contacts',
                    'title' => NULL
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
        Schema::dropIfExists('headings');
    }
}
