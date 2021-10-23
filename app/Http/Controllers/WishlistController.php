<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\PageLang;
use App\Models\StaticTextLang;
use App\Portfolio;
use App\Product;
use App\SeoBlocks;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $wishlists = Wishlist::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) {
                $query->where('status',  Helper::PUBLISHED);
            }])
            ->get();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet wishlist",'seoblock_wishlist'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_wishlist'));

        return view('wishlist.index',['wishlists'=>$wishlists,'seo_block'=>$seo_block]);
    }

    public function addWishlist()
    {
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;

        $user_id = Helper::getUserCookieId();

        if(!empty($product_id)){
            $wishlist = Wishlist::where("product_id",$product_id)->where('user_cookie_id',$user_id)->first();
            if(empty($wishlist)){
                $wishlist = new Wishlist();
                $wishlist->product_id=$product_id;
                $wishlist->user_cookie_id=$user_id;
                $wishlist->save();
            }
        }

        $count_wishlist = Wishlist::countWishlist($user_id);

        return response()->json([
            'count_wishlist' => $count_wishlist,
        ]);

    }

    public function deleteWishlist()
    {
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;

        $user_id = Helper::getUserCookieId();

        $wishlist = Wishlist::where("product_id",$product_id)->where('user_cookie_id',$user_id)->first();
        if(!empty($wishlist)){
            $wishlist->delete();
        }

        $wishlists = Wishlist::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) {
                $query->where('status',  Helper::PUBLISHED);
            }])
            ->get();

        if($type=='wishlist') {
            return view('wishlist.partials.product-items', ['wishlists' => $wishlists]);
        }
        else{
            $count_wishlist = Wishlist::countWishlist($user_id);

            return response()->json([
                'count_wishlist' => $count_wishlist,
            ]);
        }

    }



}
