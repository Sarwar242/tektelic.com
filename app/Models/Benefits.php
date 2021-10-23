<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Benefits extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'benefits';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['image','status','type','section_type'];
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

    public function benefitsLang()
    {
        return $this->hasMany('App\Models\BenefitLang');
    }

    public function benefitLang()
    {
        return $this->hasOne('App\Models\BenefitLang','benefit_id');
    }

    /*public function benefitsLang()
    {
        return $this->hasOne('App\Models\BenefitLang');
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

   /* public function setImageAttribute($value)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        // $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/uploads/benefits";

        $helper = new Helper();
        $this->attributes[$attribute_name] = $helper->uploadImage($destination_path,$value,$this);

    }*/

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
       // $disk = "public";
        $disk = config('backpack.base.root_disk_name');
        $destination_path = "public/uploads/benefits";
        $destination_path_db = "uploads/benefits";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    /* for uploads*/
    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path) {
// if a new file is uploaded, delete the file from the disk


        if(!empty($value)) {
            if (request()->hasFile($attribute_name) &&
                $this->{$attribute_name} &&
                $this->{$attribute_name} != null) {
                \Storage::disk($disk)->delete($this->{$attribute_name});
                $this->attributes[$attribute_name] = null;
            }

            // if the file input is empty, delete the file from the disk
            if (is_null($value) && $this->{$attribute_name} != null) {
                \Storage::disk($disk)->delete($this->{$attribute_name});
                $this->attributes[$attribute_name] = null;
            }

            // if a new file is uploaded, store it on disk and its filename in the database
            if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
                // 1. Generate a new file name
                $file = request()->file($attribute_name);
                $new_file_name = md5($file->getClientOriginalName() . random_int(1, 9999) . time()) . '.' . $file->getClientOriginalExtension();

                // 2. Move the new file to the correct path
                $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
                $file_path_public = Str::replaceFirst('public/', '', $file_path);
                // 3. Save the complete path to the database


                $this->attributes[$attribute_name] = $file_path_public;
            }
        }
        else{
            $this->attributes[$attribute_name] ='no';
        }

    }


}
