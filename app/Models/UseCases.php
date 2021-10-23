<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UseCases extends Model
{
    use CrudTrait;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'use_cases';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    // public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['category_id','image','status'];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [];

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
    public function useCaseLang()
    {
        return $this->hasOne('App\Models\UseCaseLang','id');
    }

    public function useCaseLangOne()
    {
        return $this->hasOne('App\Models\UseCaseLang','use_cases_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories','category_id');
    }

    public function useCaseLangForBenefit()
    {
        return $this->hasOne('App\Models\UseCaseLang','use_cases_id')->where('lang','=',Helper::ENG);
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }


    public function benefits()
    {
        return $this->belongsToMany('App\Models\Benefits','use_case_benefit','use_cases_id','benefit_id');
    }

    public function qualityLifes()
    {
        return $this->belongsToMany('App\Models\QualityLife','use_case_quality_life','use_cases_id','quality_life_id');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Models\Technology','use_case_technology','use_cases_id','technology_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getStatusAttribute($value)
    {
        if($value==1){
            return Helper::$statuses[1];
        }else{
            return Helper::$statuses[2];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setImageAttribute($value)
    {
        $attribute_name = "image";

        $destination_path = "public/uploads/use-cases";

        $helper = new Helper();
       // $this->attributes[$attribute_name] = $helper->uploadImage($destination_path,$value,$this);
        $this->attributes[$attribute_name] =  $this->uploadImage($destination_path,$value,$this);
    }

    public function uploadImage($destination_path, $value, $obj)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db

        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $path = $public_destination_path . '/' . $filename;
            return $path;
        }
        else if(empty($value)){
            return 'no';
        }
        else{
            return $this->image;
        }
    }

}
