<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class UseCases extends Model
{
    protected $table = 'use_cases';


    public function useCaseLang()
    {
        return $this->hasOne('App\Models\UseCaseLang','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Categories','category_id');
    }

    public function useCaseLangForBenefit()
    {
        return $this->hasOne('App\Models\UseCaseLang','id')->where('lang','=',Helper::ENG);
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function benefits()
    {
        return $this->belongsToMany('App\Models\Benefits','use_case_benefit','use_cases_id','benefit_id')->where('type',Helper::$types['item']);
    }

    public function qualityLifes()
    {
        return $this->belongsToMany('App\Models\QualityLife','use_case_quality_life','use_cases_id','quality_life_id')->where('type',Helper::$types['item']);
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Models\Technology','use_case_technology','use_cases_id','technology_id')->where('type',Helper::$types['item']);
    }

    public function useCaseItems()
    {
        return $this->hasMany('App\Models\UseCaseItem','use_cases_id');
    }


    public function benefitSection()
    {
        return $this->belongsToMany('App\Models\Benefits','use_case_benefit','use_cases_id','benefit_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['use_case']);
    }
    public function qualityLifeSection()
    {
        return $this->belongsToMany('App\Models\QualityLife','use_case_quality_life','use_cases_id','quality_life_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['use_case']);
    }
    public function technologySection()
    {
        return $this->belongsToMany('App\Models\Technology','use_case_technology','use_cases_id','technology_id')->where('type',Helper::$types['section'])->where('section_type',Helper::$common_section_types['use_case']);
    }

}



