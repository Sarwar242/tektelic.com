<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class StaticTextLang extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'static_text_langs';
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

    //auto adding text into tables
    public static function t($text, $category = 'general')
    {
        $messageRecord = StaticText::where('data_key',$text)->where('category',$category)->first();
        if (empty($messageRecord)) {
            $messageRecord = new StaticText();
            $messageRecord->category = $category;
            $messageRecord->message = $text;
            $messageRecord->data_key = $text;
            $messageRecord->save();
        }
        $translated = StaticTextLang::where('static_text_id',$messageRecord->id)->where('lang',Helper::ENG)->first();

        if(!empty($translated)){
            $mess = $translated->translation;
        }
        else{
            if(empty($messageRecord)) {
                $mess = $text;
            }
            else{
                $mess = $messageRecord->message;
            }
        }

        return $mess;

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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
