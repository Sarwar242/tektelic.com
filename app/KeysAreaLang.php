<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class KeysAreaLang extends Model
{
    use CrudTrait,Sluggable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'keys_area_lang';
    // protected $primaryKey = 'id';
    // public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

   /* public function updateElement($crud = false)
    {

        return '<a class="btn btn-sm btn-link" target="_blank" href="/'.$crud->route.'/" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Update</a>';
    }*/

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function langs()
    {
        return $this->hasMany('App\Models\Langs');
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function keyArea()
    {
        return $this->belongsTo('App\KeyAreas','key_ares_id');
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
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
