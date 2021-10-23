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
use App\UseCaseLang;
use App\UseCases;
use App\Models\Headings;
use Illuminate\Http\Request;

class UseCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\UseCases $useCases
     * @param $category_slug null
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UseCases $useCases,$category_slug = null)
    {
        $model = new Categories();
        $use_cases = UseCaseLang::where('lang', Helper::ENG)
            ->orderBy('use_cases_lang.featured','desc')
            ->orderBy('use_cases_lang.position','desc')
            ->rightJoin('use_cases', 'use_cases.id', '=', 'use_cases_lang.use_cases_id')
            ->where('status',  Helper::PUBLISHED);

        if(!empty($category_slug)) {
            $use_cases_ids = $model->getCategoryKeysBySlug($category_slug,[ItemKey::TYPE_USE]);
            $use_cases->whereIn('use_cases_lang.id',$use_cases_ids);
        }

        $result = $use_cases->get();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet use case",'seoblock_use_case'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_use_case'));

        $heading = Headings::where('slug','use_cases')->first();
        return view('use-cases.index', ['use_cases' => $result,'seo_block'=>$seo_block,'category_slug'=>$category_slug,'heading'=>$heading]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UseCases $useCases
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(UseCases $keyAreas, $slug)
    {
        $lang = Helper::ENG;
        /*$modelUseCase = new UseCaseLang();
        $use_case = $modelUseCase->getUsecaseBySlug($slug,$lang);*/
        $use_case = UseCaseLang::where(
            'lang', '=', $lang
        )->where('slug', '=', $slug)->with(['useCase' => function ($query) {
            $query->where('status', Helper::PUBLISHED);

        }])->first();

        if(empty($use_case)){
            abort(404);
        }


        $entities_top = Helper::getEntitiesFront('use_case','top',$use_case->useCase->id);
        $entities_bottom = Helper::getEntitiesFront('use_case','bottom',$use_case->useCase->id);

       /* $portflios = PortfolioLang::where('lang', Helper::ENG)->with(['portfolio' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->take(3)->orderBy('id','desc')->get();*/
        $portflios = PortfolioLang::where('lang', Helper::ENG)
            ->rightJoin('portfolios', 'portfolios.id', '=', 'portfolio_lang.portfolio_id')->where('status',  Helper::PUBLISHED)
            ->take(3)
            ->get();

        $products = [];
        $portfolios = [];
        $articles = [];
        if(!empty($use_case->useCase)) {
            $type_page = ItemKey::TYPE_USE;
            $keys = (new \App\ItemKey)->getKeysByItemId($use_case->id,$type_page);
            $articles = Articles::getArticlesTypeKey($keys,$use_case->id,[ItemKey::TYPE_ARTICLES],$type_page);
            $products = Product::getProductsTypeKey($keys,$use_case->id,[ItemKey::TYPE_PRODUCT],$type_page);
            $portfolios = Portfolio::getPortfoliosTypeKey($keys,$use_case->id,[ItemKey::TYPE_PORTFOLIO],$type_page);
        }

        return view('use-cases.show', [
            'use_case' => $use_case,
            'portflios'=>$portflios,
            'entities_top'=>$entities_top,
            'entities_bottom'=>$entities_bottom,
            'products' => $products,
            'portfolios' => $portfolios,
            'articles' => $articles
        ]);
    }
}
