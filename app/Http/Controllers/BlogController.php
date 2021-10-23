<?php
/*#SID - 44-new-website-page-knowledge */
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\HomeData;
use Illuminate\Http\Request;
use App\SeoBlocks;
use App\Models\StaticTextLang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Route;
use App\Pdfs;

/**
 * Class SiteController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($category, Route $route,Request $request)
    {
    	$result = [];
    	$countPaginate = 6;
    	$category = str_replace('-', ' ', strtolower($category));
    	$blogcategories = BlogCategory::getAllCategoriesByOrder();
    	$blogcategory = BlogCategory::where('name', 'like', '%' . $category . '%')->first();
    	if(!empty($blogcategory))
    	{
    		$whitepaperCategoryId = 0;
    		$isWhitepaper = 0;

    		$defaultCategory = $blogcategory->id;

    		if($blogcategory->name == "WHITEPAPERS" || $blogcategory->name == "whitepapers")
			{
				$whitepaperCategoryId = $blogcategory->id;
				$blogs = Pdfs::orderBy('id','desc');
    			$isWhitepaper = 1;
			}
    		else
    		{
    			$blogs = Blog::join('blog_categories as blogcategory', 'blogs.blog_category_id', "=", "blogcategory.id")->where('blogs.blog_category_id', $defaultCategory)->orderBy('blogs.id','desc');
    		}

	        $blogs->where('status','1');
    		if($request->ajax()) 
    		{
    			$currentPage = 1;
	            if(!empty($request->post('currentPage'))) {
	                $currentPage = $request->post('currentPage');
	            } else {
	                if(isset($_GET['page'])) {
	                    $currentPage = $_GET['page'];
	                }
	            }
	            $start_from = ($currentPage-1) * 6;
	            $blogs->skip($start_from);
        		$blogs->take(6);
	    		$result_ajax_post = $blogs->get();
	    		$products_paginator = $blogs->paginate($countPaginate);
	    		if($isWhitepaper == 1)
	    		{
	    			//dd($result_ajax_post);
	    			$result['view'] = view('blogs._parts.whitepaper_list',['pdfs' => $result_ajax_post])->render();
	    		}
	    		else
	    		{
	    			$result['view'] = view('blogs._parts.blog_list',['blogs' => $result_ajax_post])->render();	
	    		}
	    		
	    		$result['page'] = $currentPage;
	            $result['element'] = [
	                'first_item' => $products_paginator->firstItem(),
	                'count' => $products_paginator->count(),
	                'total' => $products_paginator->total(),
	            ];
	            return json_encode($result);
    		}
    		else
    		{
    			$seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet use case",'seoblock_use_case'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_use_case'));
				return view('blogs.index',[
		            'categories' => $blogcategories,
		            'categoryName' => $blogcategory->name,
		            'blogs' => $blogs->paginate($countPaginate),
		            'seo_block' => $seo_block,
		            'activeCategory' => $defaultCategory,
		            'isWhitepaper' => $isWhitepaper,
		            'action_name' => '/'.$category.'/'
		    	]);
    		}
    	}
    }

    public function single($category, $slug)
    {
    	if(isset($slug) && $slug != '')
    	{
    		$blog = Blog::join('blog_categories as blogcategory', 'blogs.blog_category_id', "=", "blogcategory.id")->where('blogs.slug', $slug)->first();
    		$related_blogs = Blog::join('blog_categories as blogcategory', 'blogs.blog_category_id', "=", "blogcategory.id")
    			->where('blogs.blog_category_id', $blog->blog_category_id)
    			->where('blogs.slug', '!=',$blog->slug)->limit(3)->get();

    		$seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet use case",'seoblock_use_case'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_use_case'));

    		return view('blogs.show',[
	            'blog' => $blog,
	            'related_blogs' => $related_blogs,
	            'seo_block' => $seo_block
        	]);
    	}
    }

    public function categoryWise($categoryId)
    {
    	$blogcategories = BlogCategory::getAllCategoriesByOrder();
    	if(!empty($blogcategories))
    	{
    		$blogs = Blog::join('blog_categories as blogcategory', 'blogs.blog_category_id', "=", "blogcategory.id")->where('blogs.blog_category_id', $categoryId)->get();

    		$seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet use case",'seoblock_use_case'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION,'seoblock_use_case'));

    		return view('blogs.index',[
	            'categories' => $blogcategories,
	            'blogs' => $blogs,
	            'seo_block' => $seo_block,
	            'activeCategory' => $categoryId
        	]);

    	}
    }
}