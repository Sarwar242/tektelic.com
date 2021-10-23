<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParrentIdColumnToProductCharacteristic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_characteristics', function (Blueprint $table) {
            $table->addColumn('integer','parent_id')->nullable();
            $table->addColumn('integer','pir')->nullable();
            $table->addColumn('integer','base')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_characteristics', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('pir');
            $table->dropColumn('base');
        });
    }
}
