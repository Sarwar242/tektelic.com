<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReformatTableProductCharacteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_characteristics', function (Blueprint $table) {
            $table->dropForeign('product_characteristics_product_id_foreign');
            $table->dropColumn('product_id');
        });

        Schema::create('product_link_characteristics', function (Blueprint $table) {
            $table->id();
            $table->addColumn('integer','products_id');
            $table->addColumn('integer','product_characteristics_id');
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
        //
    }
}
