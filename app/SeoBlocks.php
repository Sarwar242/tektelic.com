<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoBlocks extends Model
{
    public $seo_title;
    public $seo_description;

    public function __construct($seo_title,$seo_description) {
        $this->seo_title = $seo_title;
        $this->seo_description = $seo_description;
    }
}
