<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubtitle2Text2ToPortfolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_lang', function ($table) {
            $table->string('sub_title2')->default(null);
            $table->longText('text2')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio_lang', function (Blueprint $table) {
            $table->dropColumn('sub_title2');
            $table->dropColumn('text2');
        });
    }
}
