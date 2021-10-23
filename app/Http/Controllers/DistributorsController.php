<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DistributorLang;
use App\Models\PageLang;
use App\Portfolio;
use Illuminate\Http\Request;

class DistributorsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lang = Helper::ENG;

        $distributor =  PageLang::where(
            'lang', '=', $lang
        )->where('slug', '=', DistributorLang::SLUG)->with(['page' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->first();


        $distributor_items =  DistributorLang::where(
            'lang', '=', $lang
        )->with(['distributor' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->get();

        $countries = Helper::getCountriesArray($type='front');


        return view('distributors.index',['distributor'=>$distributor,'distributor_items'=>$distributor_items,'countries'=>$countries]);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    /*public function show(Portfolio $portfolio,$slug)
    {
        $lang = Helper::ENG;

        $distributor =  DistributorLang::where(
            'lang', '=', $lang
        )->with(['distributor' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->first();
        return view('portfolio.show');
    }*/

    public function distributorCountry()
    {
        $data = $_POST;

        $lang = Helper::ENG;

        $country_id = isset($data['country_id']) ? $data['country_id'] : 0;

        $distributor_items =  DistributorLang::where(
            'lang', '=', $lang
        )->with(['distributor' => function ($query) use($country_id) {
            $query->where('status',  Helper::PUBLISHED);
            if(!empty($country_id)){
                $query->where('country_id',  $country_id);
            }
        }])->get();

        return view('distributors.partials.distributor-items',['distributor_items'=>$distributor_items]);
    }


}
