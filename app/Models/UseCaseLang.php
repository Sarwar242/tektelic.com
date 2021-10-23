<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class UseCaseLang extends Model
{
    use CrudTrait,Sluggable,SluggableScopeHelpers;

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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function useCase()
    {
        return $this->belongsTo('App\Models\UseCases','use_cases_id');
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
        return $this->belongsToMany('App\Models\Benefits', 'use_case_benefit');
       // return $this->belongsToMany('App\Models\Benefits', 'use_case_benefit','benefit_id','use_cases_id');
    }

   /* public function useCaseBenefit()
    {
        return $this->hasOne('App\Models\UseCaseBenefit','use_cases_id');
    }*/

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
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }
}
