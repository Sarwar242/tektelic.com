<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('use_cases', function (Blueprint $table) {
            $table->longText('image');
        });

        Schema::table('key_ares', function (Blueprint $table) {
            $table->longText('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_cases', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('key_ares', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
