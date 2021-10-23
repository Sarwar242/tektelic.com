<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Technology extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'technologies';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['image','status','section_type','type'];
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
    public function technologyLang()
    {
        return $this->hasMany('App\Models\TechnologyLang');
    }

    public function technologyLangOne()
    {
        return $this->hasOne('App\Models\TechnologyLang');
    }

    public function useCase()
    {
        return $this->belongsTo('App\Models\UseCases','entity_id');
    }
    public function keyArea()
    {
        return $this->belongsTo('App\Models\KeyAres','entity_id');
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
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        // $disk = "public";
        $disk = config('backpack.base.root_disk_name');
        $destination_path = "public/uploads/technologies";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

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
            $this->attributes[$attribute_name] = 'no';
        }
    }

}
