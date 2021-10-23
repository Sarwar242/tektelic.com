<?php

namespace App\Models;

use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Products extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'status', 'type', 'price', 'protection', 'weight', 'category_id', 'size',
        'op_temp','images','title','subtitle','text','spec_sheet','compliance_sheet','fcc_compliance','bg_text','op_volt',
        'seo_title', 'seo_description','options','options_characteristics','slug',
        'featured', 'position'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'images' => 'array'
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }


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

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function keys()
    {
        return $this->belongsToMany('App\Models\Keys', 'product_key');
    }

    public function characteristics()
    {
        return $this->belongsToMany('App\Models\ProductCharacteristics','product_link_characteristics');
    }

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductsType', 'type');
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

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * @param $value
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "images";
        $disk = "public";
        $destination_path = "uploads/products";

        $this->uploadMultipleFilesToDisk($value,$attribute_name,$disk,$destination_path);

    }
}
