<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Helpers\Helper;
use App\Models\StaticTextLang;
use App\ItemKey;
use App\Portfolio;
use App\Product;
use App\ProductKey;
use App\SeoBlocks;
use App\Models\Headings;
use App\Widgets\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class CatalogController
 * @package App\Http\Controllers
 */
class CatalogController extends Controller
{

    /**
     * @param Route $route
     * @param Request $request
     * @param null $category_slug
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * @throws \Throwable
     */
    public function index(Route $route,Request $request,$category_slug =  null)
    {
        $result = [];
        $countPaginate = 18;
        $model = new Categories();

        $parse_data_filter = Product::parseFilterString(isset($_GET['filters']) ? $_GET['filters'] : []);
        $products = Product::getProducts(true,true,Product::STATUS_ACTIVE,true);

       if(!empty($category_slug)) {
            $use_cases_ids = $model->getCategoryKeysBySlug($category_slug,[ItemKey::TYPE_PRODUCT]);
            $products->whereIn('id',$use_cases_ids);
        }

        $categories = Categories::getCategories();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet product",'seoblock_product'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_product'));

        if($request->ajax()) {
            $is_sort = false;
            $type_r = $request->post('type');
            $result_data = $request->post('result');
            if($type_r == ProductFilter::TYPE_SORT) {
                $products = Product::sortByData($products,$result_data);
                $is_sort = true;
            }

            if($type_r == ProductFilter::TYPE_FILTER || $type_r == ProductFilter::TYPE_RANGE) {
                $products = Product::filterData($products,$result_data);
            }

            $currentPage = 1;
            if(!empty($request->post('currentPage'))) {
                $currentPage = $request->post('currentPage');
            } else {
                if(isset($_GET['page'])) {
                    $currentPage = $_GET['page'];
                }
            }
            $start_from = ($currentPage-1) * 18;
            $products->where('status',Product::STATUS_ACTIVE);
            $products->skip($start_from);
            $products->take(18);

            $url_string_filter = Product::generateUrlForFilter($request->post('result'));
            $result_ajax_post = $products->get();
            $products_paginator = $products->paginate($countPaginate);
            $result['view'] = view('products._propery.item_product',['products' => $result_ajax_post])->render();
            $result['page'] = $currentPage;
            $result['element'] = [
                'first_item' => $products_paginator->firstItem(),
                'count' => $products_paginator->count(),
                'total' => $products_paginator->total(),
            ];
            $result['url'] = !empty($url_string_filter) ? $url_string_filter : false;
            $result['is_sort'] = $is_sort;

            return json_encode($result);
        } else {
            if(!empty($parse_data_filter)) {
                if(!empty($result_type = $parse_data_filter['filters']['result_type'])) {
                    $products->whereIn('type',$result_type);
                }
                if(!empty($ids_category = $parse_data_filter['filters']['result_category'])) {
                    $model = new Categories();
                    $product_ids = $model->getKeyByIds($ids_category,[ItemKey::TYPE_PRODUCT]);
                    $products->whereIn('id',$product_ids);
                }
            }
            $heading = Headings::where('slug','products')->first();
            return view('products.index',[
                'products' => $products->paginate($countPaginate),
                'categories' => $categories,
                'category_slug'=>$category_slug,
                'action_name' => '/'.$route->getName().'/',
                'seo_block' => $seo_block,
                'heading' => $heading
            ]);
        }

    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $modelArticles = new Product();
        $product = $modelArticles->getBySlug($slug);
        if(!empty($product)) {
            $type_page = ItemKey::TYPE_PRODUCT;
            $keys = (new \App\ItemKey)->getKeysByItemId($product->id,$type_page);
            $articles = Articles::getArticlesTypeKey($keys,$product->id,[ItemKey::TYPE_ARTICLES],$type_page);
            $products = Product::getProductsTypeKey($keys,$product->id,[ItemKey::TYPE_PRODUCT],$type_page);
            $portfolios = Portfolio::getPortfoliosTypeKey($keys,$product->id,[ItemKey::TYPE_PORTFOLIO],$type_page);
            return view('products.show',[
                'product' => $product,
                'articles' => $articles,
                'products' => $products,
                'portfolios' => $portfolios,
            ]);
        }

        abort(404);
    }
}
