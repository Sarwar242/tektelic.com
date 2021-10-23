<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'requests';
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
    public function country()
    {
        return $this->belongsTo('App\Models\CountryLang','country_id');
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

 public static function saveRequest($data)
    {
        $db_request = new \App\Models\Request();
        $db_request->country_id=$data['country_id']??0;
        $db_request->body=$data['mess']??'';
        $db_request->name=$data['name']??'';
        $db_request->lastname = $data['lastname']??'';
        $db_request->company = $data['company']??'';
        $db_request->message = $data['text']??'';
        $db_request->type=$data['type'];
        $db_request->email=$data['email']??'';
        $db_request->linkedin=$data['phone_or_linkedin']??'';
        $db_request->phone=$data['phone']??'';
        $db_request->manager_email=Helper::MANAGER_EMAIL;
        $db_request->save();
        return $db_request;
    }
}
