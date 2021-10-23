<?php

use App\Models\Langs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

class InsirtToLang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $lang = new Langs();
        $lang->name='en';
        $lang->url='en';
        $lang->local='en';
        $lang->code='en';
        $lang->active=1;
        $lang->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lang', function (Blueprint $table) {
            //
        });
    }
}
