<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\KeysAreaLang;
use App\Models\Contact;
use App\Models\PageLang;
use App\Portfolio;
use App\UseCaseLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lang = Helper::ENG;

        $header_search = '';
        if (isset($_POST)) {
            $post = $_POST;
            if (isset($_POST['header_search'])) {

                $header_search = $_POST['header_search'];
                $data = Helper::getSearchResult($header_search);
                $data_count = Helper::getSearchResultCount($header_search);
            } else {
                $data = [];
                $data_count=[];

            }
        } else {
            $data = [];
            $data_count=[];
        }
        $search_text=$header_search;
        $count = count($data_count);

        $total_pages = ceil($count / Helper::PAGE_STEP);
        $page=1;
        $loadmore = $page+1;

        return view('search.index', ['data' => $data, 'search_text' => $search_text,'count'=>$count,
            'total_pages'=>$total_pages,'page'=>$page,'loadmore'=>$loadmore
            ]);
    }

    public function searchResult()
    {
        $lang = Helper::ENG;

        $search_text = isset($_POST['search_text']) ? $_POST['search_text'] : '';
        $searchcat = isset($_POST['searchcat']) ? $_POST['searchcat'] : '';
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $type = isset($_POST['type']) ? $_POST['type'] : 'page';

        $data = Helper::getSearchResult($search_text,$searchcat,$page);
        $data_count = Helper::getSearchResultCount($search_text,$searchcat);

        $count = count($data_count);
        $total_pages = ceil($count / Helper::PAGE_STEP);


            $loadmore = $page+1;

        if($type!='loadmore') {
            return view('search.partials._search', ['data' => $data, 'count' => $count, 'search_text' => $search_text,
                'total_pages' => $total_pages, 'page' => $page,'loadmore'=>$loadmore
            ]);
        }
        else{
            return view('search.partials._items', ['data' => $data, 'count' => $count, 'search_text' => $search_text,
                'total_pages' => $total_pages, 'page' => $page,'loadmore'=>$loadmore
            ]);
        }
    }


}
