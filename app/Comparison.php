<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    protected $table = 'comparisons';

    public static function countComparison($user_id=null)
    {
        $count_entity = Comparison::where('user_cookie_id',$user_id)->get();
        if(!empty($count_entity)) {
            $count = $count_entity->count();
        }
        else{
            $count = 0;
        }
        return $count;
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

    public static function check($product)
    {
        $user_id = Helper::getUserCookieId();
        $compare = Comparison::where("product_id",$product->id)->where('user_cookie_id',$user_id)->first();
        return $compare;
    }

}
