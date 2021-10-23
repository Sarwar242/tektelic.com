<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Helpers\Helper;
use App\ItemKey;
use App\Models\StaticTextLang;
use App\Portfolio;
use App\PortfolioLang;
use App\Product;
use App\SeoBlocks;
use App\Models\Headings;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($category_slug=null)
    {
        $categories = Categories::getCategories();
        $portflios = PortfolioLang::where('lang', Helper::ENG)
            ->orderBy('featured','desc')
            ->orderBy('position','desc')
            ->with(['portfolio' => function ($query){
                $query->where('status',  Helper::PUBLISHED);
            }]);
        $model = new Categories();
        if(!empty($category_slug)) {
            $portfolio_ids = $model->getCategoryKeysBySlug($category_slug,[ItemKey::TYPE_PORTFOLIO]);
            $portflios->whereIn('id',$portfolio_ids);
        }

        $results = $portflios->get();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet portfolio",'seoblock_portfolio'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION.'portfolio','seoblock_portfolio'));

        $heading = Headings::where('slug','success_stories')->first();

        return view('portfolio.index',['portflios'=>$results, 'categories' => $categories,'category_slug'=>$category_slug,'seo_block'=>$seo_block,'heading'=>$heading]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Portfolio $portfolio
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Portfolio $portfolio, string $slug)
    {
        $lang = Helper::ENG;

        $portfolio = PortfolioLang::where('lang', '=', $lang)->where('slug', '=', $slug)
            ->with(['portfolio' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->first();

        if(empty($portfolio)){
            abort(404);
        }

        $type_page = ItemKey::TYPE_PORTFOLIO;
        $keys = (new \App\ItemKey)->getKeysByItemId($portfolio->id,$type_page);
        $articles = Articles::getArticlesTypeKey($keys,$portfolio->id,[ItemKey::TYPE_ARTICLES],$type_page);
        $products = Product::getProductsTypeKey($keys,$portfolio->id,[ItemKey::TYPE_PRODUCT],$type_page);
        $portfolios = Portfolio::getPortfoliosTypeKey($keys,$portfolio->id,[ItemKey::TYPE_PORTFOLIO],$type_page);

        return view('portfolio.show',[
            "portfolio"=>$portfolio,
            'products' => $products,
            'portfolios' => $portfolios,
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
