<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertToPagesAboutUsDistributors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $page = new \App\Models\Page();
        $page->name = 'About us';
        $page->title = 'ABOUT US';
        $page->sub_title = 'Our Team';
        $page->template = 'page';
        $page->slug = 'about-us';
        $page->content = 'The TEKELIC R&D team is comprised of experts in a wide range of technical disciplines. Having begun in 2009, TEKTELIC’s core team came from Nortel Network’s main RF and Base Station design team.

Since then TEKTELIC has selected and added new team members to its technical staff from all over North America and Europe. Most team members possess a Master’s degree or above and are typically trained experts in the areas of radio and system design, digital signal processing, mechanical and thermal design, power, protection and grounding.

All these skills sets enable TEKTELIC to build high quality carrier grade products for its clients.';
        $page->status = 1 ;
        $page->save();

        $page_lang = new \App\Models\PageLang();
        $page_lang->title = 'ABOUT US';
        $page_lang->sub_title = 'Our Team';
        $page_lang->slug = 'about-us';
        $page_lang->text = 'The TEKELIC R&D team is comprised of experts in a wide range of technical disciplines. Having begun in 2009, TEKTELIC’s core team came from Nortel Network’s main RF and Base Station design team.

Since then TEKTELIC has selected and added new team members to its technical staff from all over North America and Europe. Most team members possess a Master’s degree or above and are typically trained experts in the areas of radio and system design, digital signal processing, mechanical and thermal design, power, protection and grounding.

All these skills sets enable TEKTELIC to build high quality carrier grade products for its clients.';
        $page_lang->lang = 'en';
        $page_lang->page_id = $page->id;
        $page_lang->save();

        // distributor

        $page = new \App\Models\Page();
        $page->name = 'DISTRIBUTORS';
        $page->title = 'DISTRIBUTORS';
        $page->template = 'page';
        $page->sub_title = '“TEKTELIC has a world-class network  of trusted global distribution partners.';
        $page->slug = 'distributors';
        $page->content = 'Find your local TEKTELIC distributor below, or contact  info@tektelic.com for more information';
        $page->status = 1 ;
        $page->save();

        $page_lang = new \App\Models\PageLang();
        $page_lang->title = 'DISTRIBUTORS';
        $page_lang->sub_title = '“TEKTELIC has a world-class network  of trusted global distribution partners.';
        $page_lang->slug = 'distributors';
        $page_lang->text = 'Find your local TEKTELIC distributor below, or contact  info@tektelic.com for more information';
        $page_lang->lang = 'en';
        $page_lang->page_id = $page->id;
        $page_lang->save();



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages_about_us_distributors', function (Blueprint $table) {
            //
        });
    }
}
