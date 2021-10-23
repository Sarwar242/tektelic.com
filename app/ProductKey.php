<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKey extends Model
{
    protected $table = 'product_key';
    // protected $primaryKey = 'id';
    // public $timestamps = false;


    /**
     * @param $keys array
     * @return mixed
     */
    public static function getItemsByKey(array $keys)
    {
        return self::whereIn('keys_id',$keys)->pluck('products_id', 'products_id')->all();
    }
}
