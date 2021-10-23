<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class KeyAreas extends Model
{
    protected $table = 'key_ares';

    public function keyAreaLang()
    {
        return $this->hasOne('App\Models\KeysAreaLang', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories','category_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function benefits()
    {
        return $this->belongsToMany('App\Models\Benefits','key_area_benefit','key_area_id','benefit_id')->where('type',Helper::$types['item']);
    }


    public function qualityLifes()
    {
        return $this->belongsToMany('App\Models\QualityLife','key_area_quality_life','key_area_id','quality_life_id')->where('type',Helper::$types['item']);
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Models\Technology','key_area_technology','key_area_id','technology_id')->where('type',Helper::$types['item']);
    }


    public function benefitSection()
    {
        return $this->belongsToMany('App\Models\Benefits','key_area_benefit','key_area_id','benefit_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['key_area']);
    }
    public function technologySection()
    {
        return $this->belongsToMany('App\Models\Technology','key_area_technology','key_area_id','technology_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['key_area']);
    }
    public function qualityLifeSection()
    {
        return $this->belongsToMany('App\Models\QualityLife','key_area_quality_life','key_area_id','quality_life_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['key_area']);
    }

}


