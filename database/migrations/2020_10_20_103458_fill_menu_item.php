<?php

use App\Models\MenuItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillMenuItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $top='top';
        $left='left';
        $footer1='footer1';
        $footer2='footer2';

        $menu_item = new MenuItem();
        $menu_item->title = 'CATALOG';
        $menu_item->link = 'catalog';
        $menu_item->pos = $top;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'KEY AREAS';
        $menu_item->link = 'key-areas';
        $menu_item->pos = $top;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'PROJECTS PORTFOLIO';
        $menu_item->link = 'projects-portfolio';
        $menu_item->pos = $top;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'USE CASES';
        $menu_item->link = 'use-cases';
        $menu_item->pos = $top;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'KEY AREAS';
        $menu_item->link = 'key-areas';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'PROJECTS PORTFOLIO';
        $menu_item->link = 'projects-portfolio';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'USE CASES';
        $menu_item->link = 'use-cases';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'KNOWLEDGE BASE';
        $menu_item->link = 'articles';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'DISTRIBUTORS';
        $menu_item->link = 'distributors';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'ABOUT US';
        $menu_item->link = 'about-us';
        $menu_item->pos = $left;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'USE CASES';
        $menu_item->link = 'use-cases';
        $menu_item->pos = $footer1;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'KEY AREAS';
        $menu_item->link = 'key-areas';
        $menu_item->pos = $footer1;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'PROJECTS PORTFOLIO';
        $menu_item->link = 'projects-portfolio';
        $menu_item->pos = $footer1;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'CATALOG';
        $menu_item->link = 'catalog';
        $menu_item->pos = $footer1;
        $menu_item->save();


        $menu_item = new MenuItem();
        $menu_item->title = 'Knowledge base';
        $menu_item->link = 'articles';
        $menu_item->pos = $footer2;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'Distributors';
        $menu_item->link = 'distributors';
        $menu_item->pos = $footer2;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'About us';
        $menu_item->link = 'about-us';
        $menu_item->pos = $footer2;
        $menu_item->save();

        $menu_item = new MenuItem();
        $menu_item->title = 'Search';
        $menu_item->link = 'search';
        $menu_item->pos = $footer2;
        $menu_item->save();



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
