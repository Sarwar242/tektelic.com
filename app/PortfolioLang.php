<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PortfolioLang extends Model
{

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'portfolio_lang';
    // protected $primaryKey = 'id';
    // public $timestamps = false;


    public static $statuses =[
        1=>'yes',
        2=>'no'
    ];

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
    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolios');
    }
    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function category()
    {
        return $this->hasOneThrough('App\Categories', 'App\Models\Portfolios');
    }

    public function langs()
    {
        return $this->hasMany('App\Models\Langs');
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
