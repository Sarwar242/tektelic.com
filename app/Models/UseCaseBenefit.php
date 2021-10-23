<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class UseCaseBenefit extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'use_case_benefit';
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
    /*public static function getUseCasesArray()
    {
        $entities = UseCaseLang::where('lang', Helper::ENG)->with(['useCase' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->use_cases_id]=$entity->title;
        }
        return $entities_arr;
    }

    public static function getBenefitsArray()
    {
        $entities = BenefitLang::where('lang', Helper::ENG)->with(['benefit' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->benefit_id]=$entity->title;
        }
        return $entities_arr;
    }*/

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function useCase()
    {
        return $this->belongsTo('App\Models\UseCases','use_cases_id');
    }

    public function benefit()
    {
        return $this->belongsTo('App\Models\Benefits','benefit_id');
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
