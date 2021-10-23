<?php
//#SID - #z3c3nz - Career page On Tektelic
namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\StaticTextLang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Route;
use App\Career;
use App\SeoBlocks;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class CareerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Route $route,Request $request)
    {
    	$careers = Career::orderBy('id', 'DESC')->get();
    	$seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet use case",'seoblock_use_case'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_use_case'));
		return view('career.index',[
            'careers' => $careers,
		    'seo_block' => $seo_block
    	]);

    }
}