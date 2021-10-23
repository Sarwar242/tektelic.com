<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Helpers\Helper;
use App\ItemKey;
use App\KeyAreas;
use App\KeysAreaLang;
use App\Models\StaticTextLang;
use App\Portfolio;
use App\PortfolioLang;
use App\Product;
use App\SeoBlocks;
use App\Models\Headings;
use Illuminate\Http\Request;

class KeyAreasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\KeyAreas  $keyAreas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(KeyAreas $keyAreas)
    {
        // $key_areas = KeysAreaLang::all();
        $key_areas = KeysAreaLang::where('lang', Helper::ENG)
            ->orderBy('keys_area_lang.featured','desc')
            ->orderBy('keys_area_lang.position','desc')
            ->rightJoin('key_ares', 'key_ares.id', '=', 'keys_area_lang.key_ares_id')->where('status',  Helper::PUBLISHED)
            ->get();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet key area",'seoblock_key_area'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_key_area'));

        $heading = Headings::where('slug','key_areas')->first();

        return view('key-areas.index',['key_areas'=>$key_areas,'seo_block'=>$seo_block,'heading'=>$heading]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KeyAreas  $keyAreas
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(KeyAreas $keyAreas,$slug)
    {
        $lang = Helper::ENG;
        /*$modelUseCase = new UseCaseLang();
        $use_case = $modelUseCase->getUsecaseBySlug($slug,$lang);*/
        $key_area = KeysAreaLang::where(
            'lang', '=', $lang
        )->where('slug', '=', $slug)->with(['keyArea' => function ($query) {
            $query->where('status', Helper::PUBLISHED);

        }])->first();

        if(empty($key_area)){
            abort(404);
        }


        $entities_top = Helper::getEntitiesFront('key_area','top',$key_area->keyArea->id);
        $entities_bottom = Helper::getEntitiesFront('key_area','bottom',$key_area->keyArea->id);

        /*$benefit_section = Helper::getSectionArray($key_area->keyArea->benefitSection,Helper::$section_types[1]);
        $quality_life_section = Helper::getSectionArray($key_area->keyArea->qualityLifeSection,Helper::$section_types[2]);
        $tech_section = Helper::getSectionArray($key_area->keyArea->technologySection,Helper::$section_types[3]);*/
       // $quality_life_section = Helper::getSectionArray($key_area->keyArea->qualityLifeSection,Helper::$section_types[3]);

//        $portflios = PortfolioLang::where('lang', Helper::ENG)->with(['portfolio' => function ($query) {
//            $query->where('status',  Helper::PUBLISHED);
//        }])->take(3)->orderBy('id','desc')->get();


        $category = Categories::getCategoryById($key_area->keyArea->category_id);
        $products = [];
        $portfolios = [];
        $articles = [];
        if(!empty($key_area->keyArea)) {
            $type_page = ItemKey::TYPE_AREA;
            $keys = (new \App\ItemKey)->getKeysByItemId($key_area->id,$type_page);
            $articles = Articles::getArticlesTypeKey($keys,$key_area->id,[ItemKey::TYPE_ARTICLES],$type_page);
            $products = Product::getProductsTypeKey($keys,$key_area->id,[ItemKey::TYPE_PRODUCT],$type_page);
            $portfolios = Portfolio::getPortfoliosTypeKey($keys,$key_area->id,[ItemKey::TYPE_PORTFOLIO],$type_page);
        }

        return view('key-areas.show',[
            'key_area'=>$key_area,
//            'portflios'=>$portflios,
            'entities_top'=>$entities_top,
            'entities_bottom'=>$entities_bottom,
            'products' => $products,
            'portfolios' => $portfolios,
            'articles' => $articles
        ]);
    }

}
