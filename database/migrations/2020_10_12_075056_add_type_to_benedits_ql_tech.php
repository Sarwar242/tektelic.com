<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToBeneditsQlTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->string('type')->default('item');
        });

        Schema::table('quality_lifes', function (Blueprint $table) {
            $table->string('type')->default('item');
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->string('type')->default('item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('quality_lifes', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
