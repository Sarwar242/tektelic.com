<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    public static function countWishlist($user_id=null)
    {
        $count_wishlist = Wishlist::where('user_cookie_id',$user_id)->get();
        if(!empty($count_wishlist)) {
            $count = $count_wishlist->count();
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
        $wishlist = Wishlist::where("product_id",$product->id)->where('user_cookie_id',$user_id)->first();
        return $wishlist;
    }

}
