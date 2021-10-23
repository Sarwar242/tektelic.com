<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Helpers\Helper;
use App\Models\StaticTextLang;
use App\ItemKey;
use App\Portfolio;
use App\Product;
use App\SeoBlocks;
use App\Models\Headings;
use App\Widgets\ProductFilter;
use Backpack\NewsCRUD\app\Models\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\View\View;
use Throwable;

class ArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Route $route
     * @param Request $request
     * @param string $category_slug
     * @return array|string
     * @throws Throwable
     */
    public function index(Route $route,Request $request,$category_slug = null)
    {
        $result = [];
        $countPaginate = 5;
        $model = new Categories();

        $parse_data_filter = Product::parseFilterString(isset($_GET['filters']) ? $_GET['filters'] : []);
        $posts = Articles::getArticles( null,true,Articles::STATUS_PUBLISHED,true);
        /*if(!empty($category_slug)) {
            $articles_id = $model->getCategoryKeysBySlug($category_slug,[ItemKey::TYPE_ARTICLES]);
            $posts->whereIn('id',$articles_id);
        }*/
        $categories = Categories::getCategories();
        $seo_block = new SeoBlocks(StaticTextLang::t(
            "Lorem ipsum dolor sit amet articles",
            'seoblock_articles'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,
            'seoblock_articles')
        );

        if($request->ajax()) {
            $type = $request->post('type');
            if($type == ProductFilter::TYPE_FILTER)
                $posts = Articles::filterData($posts,$request->post('result'));
            $currentPage = 1;
            if(!empty($request->post('currentPage'))) {
                $currentPage = $request->post('currentPage');
            } else {
                if(isset($_GET['page'])) {
                    $currentPage = $_GET['page'];
                }
            }
            $start_from = ($currentPage-1) * 5;
            $posts->where('status',Articles::STATUS_PUBLISHED);
            $posts->skip($start_from);
            $posts->take(5);
            $url_string_filter = Product::generateUrlForFilter($request->post('result'),$currentPage);
            $result_ajax_post = $posts->get();
            $article_paginator = $posts->paginate($countPaginate);
            $result['view'] = view('articles._parts.item',['posts' => $result_ajax_post])->render();
            $result['page'] = $currentPage;
            $result['element'] = [
                'first_item' => $article_paginator->firstItem(),
                'count' => $article_paginator->count(),
                'total' => $article_paginator->total(),
            ];
            $result['url'] = $url_string_filter;
            $result['is_sort'] = false;
            return json_encode($result);
        } else {				   
            $heading = Headings::where('slug','knowledge_base')->first();
            $modelArticles = new Articles();
            if(isset($parse_data_filter['filters'])) {
                if(!empty($result_tags = $parse_data_filter['filters']['result_tags'])) {
                    $posts = $modelArticles->getPostQueryByTag($posts,$result_tags);
                }
                if(!empty($result_key = $parse_data_filter['filters']['result_key'])) {
                    $posts = $modelArticles->filterByCategories($result_key,$posts,ItemKey::TYPE_AREA);
                }
                if(!empty($result_use = $parse_data_filter['filters']['result_use'])) {
                    $posts = $modelArticles->filterByCategories($result_use,$posts,ItemKey::TYPE_USE);
                }
            }
            return view('articles.index',[
                'posts' => $posts->paginate($countPaginate),
                'categories' => $categories,
                'category_slug' => $category_slug,
                'action_name' => '/'.$route->getName().'/'.$category_slug,
                'seo_block' => $seo_block,
                'heading' => $heading
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Articles $articles
     * @param string $slug
     * @return Factory|View
     */
    public function show(Articles $articles, string $slug)
    {
        $modelArticles = new Articles();
        $post = $modelArticles->getArticleBySlug($slug);
        if(empty($post)) {
            abort(404);
        }

        $type_page = ItemKey::TYPE_ARTICLES;
        $keys = (new \App\ItemKey)->getKeysByItemId($post->id,$type_page);
        $posts = Articles::getArticlesTypeKey($keys,$post->id,[ItemKey::TYPE_ARTICLES],$type_page);
        $products = Product::getProductsTypeKey($keys,$post->id,[ItemKey::TYPE_PRODUCT],$type_page);

        $lastArticles = Articles::getLastArticles(5);
        return view('articles.show',[
            'post' => $post,
            'posts' => $posts,
            'products' => $products,
            'lastArticles' => $lastArticles
        ]);
    }
}
