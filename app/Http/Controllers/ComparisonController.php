<?php

namespace App\Http\Controllers;

use App\Comparison;
use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\PageLang;
use App\Models\ProductsType;
use App\Models\StaticTextLang;
use App\Portfolio;
use App\SeoBlocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addComparison()
    {
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;

        $user_id = Helper::getUserCookieId();

        if(!empty($product_id)){
            $comparison = Comparison::where("product_id",$product_id)->where('user_cookie_id',$user_id)->first();
            if(empty($comparison)){
                $comparison = new Comparison();
                $comparison->product_id=$product_id;
                $comparison->user_cookie_id=$user_id;
                $comparison->save();
            }
        }

        $count_comparison = Comparison::countComparison($user_id);

        return response()->json([
            'count_comparison' => $count_comparison,
        ]);

    }

    public function index()
    {
        $user_id = Helper::getUserCookieId();

        $product_types=ProductsType::getType();

        $product_type_one=ProductsType::getOneType($product_types);

        $comparisons = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) use($product_type_one) {
                $query->where('status',  Helper::PUBLISHED);
                if(!empty($product_type_one)){
                    $query->where('type',  $product_type_one);
                }
            }])
            ->get();

        $comparison_one = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) {
                $query->where('status',  Helper::PUBLISHED);
            }])
            ->first();



        $product_types=ProductsType::getTypes($product_types);


        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet compare",'seoblock_compare'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_compare'));


        return view('compare.index',['comparisons'=>$comparisons,'product_types'=>$product_types,'comparison_one'=>$comparison_one,'seo_block'=>$seo_block,'product_type0'=>$product_type_one]);
    }


    public function compareType()
    {
        $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : null;

        $user_id = Helper::getUserCookieId();

        if($product_type=='all'){
            $comparisons = Comparison::where('user_cookie_id', Helper::getUserCookieId())
                ->rightJoin('products', 'products.id', '=', 'comparisons.product_id')->where('status', Helper::PUBLISHED)
                ->get();
        }
        else {
            $comparisons = Comparison::where('user_cookie_id', Helper::getUserCookieId())
                ->rightJoin('products', 'products.id', '=', 'comparisons.product_id')->where('status', Helper::PUBLISHED)
                ->where('type', $product_type)
                ->get();
        }
        $ajax=1;

       // dd($comparisons);
        return view('compare.partials.product-items',['comparisons'=>$comparisons,'ajax'=>$ajax,'product_type'=>$product_type,'product_type0'=>$product_type]);

    }

    public function compareAside()
    {
        $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : null;

        $user_id = Helper::getUserCookieId();

        $comparisons = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) use ($product_type) {
                $query->where('status',  Helper::PUBLISHED);
                if(!empty($product_type)) {
                    $query->where('type', $product_type);
                }
            }])
            ->get();

        $comp_count = $comparisons->count();

        if(!empty($comparisons)) {
            foreach ($comparisons as $comparison) {
                if (!empty($comparison->product)) {
                    $comparison_one = $comparison;
                    break;
                }
            }
        }
        else{
            $comparison_one=null;
        }


        $ajax=1;
        return view('compare.partials.compare-aside',['comparison_one'=>$comparison_one,'ajax'=>$ajax,'product_type0'=>$product_type]);

    }


    public function deleteComparison()
    {
        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;

        $user_id = Helper::getUserCookieId();

        $comparison = Comparison::where("product_id",$product_id)->where('user_cookie_id',$user_id)->first();
        if(!empty($comparison)){
            $comparison->delete();
        }

        $wishlists = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) {
                $query->where('status',  Helper::PUBLISHED);
            }])
            ->get();

        if($type=='compare') {
          //  return view('wishlist.partials.product-items', ['wishlists' => $wishlists]);
        }
        else{
            $count_comparison = Comparison::countComparison($user_id);

            return response()->json([
                'count_comparison' => $count_comparison,
            ]);
        }

    }

}
