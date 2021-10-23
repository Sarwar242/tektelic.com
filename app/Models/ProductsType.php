<?php

namespace App\Models;

use App\Comparison;
use App\Helpers\Helper;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ProductsType extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_type';
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

    /**
     * @return array
     */
    public static function getType()
    {
        return self::all()->keyBy('id')->pluck('name', 'id')->toArray();
    }
    public static function getTypes($product_types)
    {
        $product_types_arr=[];
       if(!empty($product_types)){
           foreach($product_types as $id => $product_type) {
               $comparison = Comparison::where('user_cookie_id',Helper::getUserCookieId())
                   ->rightJoin('products', 'products.id', '=', 'comparisons.product_id')->where('status',  Helper::PUBLISHED)
                   ->where('type',$id)
                   ->first();
             //  echo $id." ".$comparison->product_id." "."<br>";
               if(!empty($comparison)) {

                   $product_types_arr[$id] = $product_type;
               }
           }
       }

       return $product_types_arr;
    }
    public static function getOneType($product_types)
    {
        $product_types_arr=[];
        if(!empty($product_types)){
            foreach($product_types as $id => $product_type) {
                $comparison = Comparison::where('user_cookie_id',Helper::getUserCookieId())
                    ->rightJoin('products', 'products.id', '=', 'comparisons.product_id')->where('status',  Helper::PUBLISHED)
                    ->where('type',$id)
                    ->first();
                //  echo $id." ".$comparison->product_id." "."<br>";
                if(!empty($comparison)) {

                    $product_types_arr = $id;
                    break;
                }
            }
        }

        return $product_types_arr;
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
