<?php

namespace App;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class UseCaseLang extends Model
{
    //use CrudTrait,Sluggable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'use_cases_lang';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getUsecaseBySlug($slug,$lang)
    {
        return UseCaseLang::all()->where('slug','=',$slug)->where('lang', Helper::ENG);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function useCase()
    {
        return $this->belongsTo('App\UseCases','use_cases_id');
    }

    public function langs()
    {
        return $this->hasMany('App\Models\Langs');
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function benefits()
    {
      //  return $this->belongsToMany('App\Models\Benefits', 'use_case_benefit');
        return $this->belongsToMany('App\Models\Benefits', 'use_case_benefit','benefit_id','use_cases_id');
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

}
