<?php

namespace App\Models;

use App\Helpers\Helper;
use App\ItemKey;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristics extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    const TYPE_SET_FILTER = 1;
    protected $table = 'product_characteristics';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        return self::where('id',$id)->first();
    }

    /**
     * @return array
     */
    public static function getItemsForAdmin()
    {
        $result = [];
        $data = self::all();
        foreach ($data as $datum) {
            if($datum->type == Helper::TYPE_CHECKED_ITEM) {
                $result[$datum->id]['name'] = $datum->name;
                $result[$datum->id]['type'] = 'checkbox';
            }
            if($datum->type == Helper::TYPE_STRING_ITEM) {
                $result[$datum->id]['name'] = $datum->name;
                $result[$datum->id]['type'] = 'text';
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    public static function getListItemType()
    {
        return ProductTypeItemFilter::all()->keyBy('id')->pluck('name', 'id')->toArray();
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function products()
    {
        return $this->belongsToMany('App\Models\Models\Products', 'product_link_characteristics');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\PropductCharacteristicsBlock', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeItemFilter()
    {
        return $this->belongsTo('App\Models\ProductTypeItemFilter', 'product_type_item_filters');
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
