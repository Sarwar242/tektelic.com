<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionTypeToBenefitsQlTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('benefits', function (Blueprint $table) {
            $table->string('section_type')->default('key_area');
        });

        Schema::table('quality_lifes', function (Blueprint $table) {
            $table->string('section_type')->default('key_area');
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->string('section_type')->default('key_area');
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
            $table->dropColumn('section_type');
        });
        Schema::table('quality_lifes', function (Blueprint $table) {
            $table->dropColumn('section_type');
        });
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn('section_type');
        });
    }
}
