<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\KeysAreaLang;
use App\Articles;
use App\Models\PortfolioLang;
use App\Models\Products;
use App\Models\StaticTextLang;
use App\Product;
use App\SeoBlocks;
use App\Slider;
use App\UseCaseLang;
use App\Pdfs;
use App\Testimonial;
use App\Youtubes;
use App\Models\HomeData;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = Articles::getArticles(4,null,false,Articles::STATUS_PUBLISHED,true);
        $slider_items = Slider::getSliderItems(1);
        $slider__second_items = Slider::getSliderItems(2);
        $portflios = PortfolioLang::where('lang', Helper::ENG)
            ->take(3)
            ->orderBy('portfolio_lang.featured','desc')
            ->orderBy('portfolio_lang.position','desc')
            ->rightJoin('portfolios', 'portfolios.id', '=', 'portfolio_lang.portfolio_id')->where('status',  Helper::PUBLISHED)
            ->get();
        $use_cases = UseCaseLang::where('lang', Helper::ENG)
            ->take(3)
            ->orderBy('use_cases_lang.featured','desc')
            ->orderBy('use_cases_lang.position','desc')
            ->rightJoin('use_cases', 'use_cases.id', '=', 'use_cases_lang.use_cases_id')->where('status',  Helper::PUBLISHED)
            ->get();

        $key_areas_arr = Helper::getKeyAreaForMainPage();
        $products = Product::getProducts(true,false,Product::STATUS_ACTIVE,true);

        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet",'seoblock_main'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_main'));

        $homeData = [
            'use_case'=>HomeData::where('slug','use_case')->first(),
            'key_areas'=>HomeData::where('slug','key_areas')->first(),
            'case_studies'=>HomeData::where('slug','case_studies')->first(),
            'products'=>HomeData::where('slug','products')->first(),
            'news'=>HomeData::where('slug','news')->first(),
            'pdfs'=>HomeData::where('slug','pdfs')->first(),
        ];

        //SD
        $pdfs = Pdfs::orderBy('id','desc')->take(3)->get();
        
        //#SID - 46-testimonials-slider-section-for-the-homepage
        $testimonials = Testimonial::orderBy('id','desc')->get();

        //#SID - 30-video-section-for-the-homepage
        $videos = Youtubes::first();
        
        return view('site.index',[
            'articles' => $articles,
            'slider_items' => $slider_items,
            'slider__second_items' => $slider__second_items,
            'portflios'=>$portflios,
            'use_cases'=>$use_cases,
            'key_areas_arr'=>$key_areas_arr,
            'products' => $products,
            'seo_block' => $seo_block,
            'homeData' => $homeData,
            'pdfs' => $pdfs,
            'testimonials' => $testimonials,
            'videos' => $videos
        ]);
    }

    public function tnc() {
        return redirect('/public/uploads/pages/TEKTELIC_Terms_and_Conditions.pdf');
    }

}
