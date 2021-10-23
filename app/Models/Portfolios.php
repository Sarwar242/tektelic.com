<?php

namespace App\Models;

use App\Categories;
use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class News
 * @package App
 */
class Portfolios extends Model
{
    use CrudTrait;

    protected $table = 'portfolios';
    protected $fillable = ['category_id','image','status'];

    public function getAllPortfolios()
    {

    }

    public function portfolioLang()
    {
        return $this->hasOne('App\Models\PortfolioLang','portfolio_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Categories');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories','category_id');
    }

    /**
     * @return mixed
     */
    public function getTypeKeyCategory()
    {
        return Categories::getCategoryById($this->category_id)->key()->type();
    }

    // accessors
    public function getStatusAttribute($value)
    {
        if($value==1){
            return Helper::$statuses[1];
        }else{
            return Helper::$statuses[2];
        }
    }

    //mutators

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        // $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/uploads/portfolios";

      //  $helper = new Helper();
      //  $this->attributes[$attribute_name] = $helper->uploadImage($destination_path,$value,$this);
        $this->attributes[$attribute_name] =  $this->uploadImage($destination_path,$value,$this);
    }

    /* Added here instead of helper because it doesn't add empty images if it is called via helper uploadImage */
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
