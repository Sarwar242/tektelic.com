<?php

namespace App\Helpers;


use App\Comparison;
use App\Models\BenefitLang;
use App\Models\Category;
use App\Models\CountryLang;
use App\Models\EntityType;
use App\Models\KeyAres;
use App\Models\KeysAreaLang;
use App\Models\ProductsType;
use App\Models\QualityLifesLang;
use App\Models\Technology;
use App\Models\TechnologyLang;
use App\Models\UseCaseLang;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Helper
{
    const MANAGER_EMAIL = 'info@tektelic.com';
    const MANAGER_EMAIL2 = 'mgrigoriev@tektelic.com';
    const MANAGER_EMAIL3 = 'fedevih494@pxjtw.com';
    const MANAGER_EMAIL4 = 'laconic.design.com@gmail.com';
   // const SENDER = 'web-line@tektelic.com';
    const SENDER = 'website@tektelic.com';
    const PAGE_STEP = 4;

    const ENG = 'en';
    const GE = 'ge';
    const UPDATE_BUTTON = 'Update';

    const TYPE_STRING_ITEM = 1;
    const TYPE_CHECKED_ITEM = 2;

    const PUBLISHED = 1;

    const DEFAULT_SEO_DESCRIPTION="
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    ";

    public static $statuses = [
        1 => 'Published',
        2 => 'Not Published'
    ];

    public static $types = [
        'item' => 'Item',
        'section' => 'Section'
    ];

    public static $positions = [
        'top' => 'Top',
        'bottom' => 'Bottom'
    ];

    public static $menu_positions = [
        'top' => 'Top',
        'left' => 'Left',
        'footer1' => 'Footer 1',
        'footer2' => 'Footer 2',
    ];

    public static $searchCat = [
        'catalog' => 'catalog',
        'key_areas' => 'key_areas',
        'projects_portfolio' => 'projects_portfolio',
        'use_cases' => 'use_cases',
        'knowledge_base' => 'knowledge_base',
    ];


    public static $section_types = [
        1 => 'benefit',
        2 => 'quality_life',
        3 => 'tech',
    ];

    public static $common_section_types = [
        'key_area' => 'key_area',
        'use_case' => 'use_case',
    ];

    public static $type_characteristic = [
        self::TYPE_CHECKED_ITEM => 'Checkbox',
        self::TYPE_STRING_ITEM => 'String',
    ];


    public static $contact_types = [
        'address' => 'Address',
        'phone' => 'Phone',
        'email' => 'Email',
    ];

    //public $image;


    public function uploadImage($destination_path, $value, $obj)
    {


        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($obj->{$attribute_name});

            // set null in the database column
            $obj->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db

        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($obj->{$attribute_name});

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $path = $public_destination_path . '/' . $filename;
            return $path;
        } else {

            return $obj->image;
        }

    }

    /* for uploads*/
    public static function uploadFileToDisk($value, $attribute_name, $disk, $destination_path, $destination_path_db, $obj)
    {
// if a new file is uploaded, delete the file from the disk
        if (request()->hasFile($attribute_name) &&
            $obj->{$attribute_name} &&
            $obj->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($obj->{$attribute_name});
            $obj->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $obj->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($obj->{$attribute_name});
            $obj->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = request()->file($attribute_name);
            $new_file_name = md5($file->getClientOriginalName() . random_int(1, 9999) . time()) . '.' . $file->getClientOriginalExtension();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);
            $file_path_public = Str::replaceFirst('public/', '', $file_path);
            // 3. Save the complete path to the database


            $obj->attributes[$attribute_name] = $file_path_public;
        }

    }


    public static function getUseCasesArray()
    {
        $entities = UseCaseLang::where('lang', Helper::ENG)->with(['useCase' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->use_cases_id] = $entity->title;
        }
        return $entities_arr;
    }

    public static function getKeyAreasArray()
    {
        $entities = KeysAreaLang::where('lang', Helper::ENG)->with(['keyArea' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->key_ares_id] = $entity->title;
        }
        return $entities_arr;
    }

    public static function getBenefitsArray()
    {
        $entities = BenefitLang::where('lang', Helper::ENG)->with(['benefit' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->benefit_id] = $entity->title;
        }
        return $entities_arr;
    }

    public static function getQualitylifeArray()
    {
        $entities = QualityLifesLang::where('lang', Helper::ENG)->with(['qualityLife' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->quality_life_id] = $entity->title;
        }
        return $entities_arr;
    }

    public static function getTechnologyArray()
    {
        $entities = TechnologyLang::where('lang', Helper::ENG)->with(['technology' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->technology_id] = $entity->title;
        }
        return $entities_arr;
    }


    public static function getUseCaseArray()
    {
        $entities = UseCaseLang::where('lang', Helper::ENG)->with(['useCase' => function ($query) {
            $query->where('status', Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];
        foreach ($entities as $entity) {
            $entities_arr[$entity->use_cases_id] = $entity->title;
        }
        return $entities_arr;
    }


    public static function getCountriesArray($type='back')
    {
        $entities = CountryLang::where('lang', Helper::ENG)->with(['country' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->get();
        $entities_arr = [];

        if($type=='front'){
            $entities_arr[0]='All';
        }

        foreach ($entities as $entity) {
            $entities_arr[$entity->country_id]=$entity->title;
        }
        return $entities_arr;
    }


    public static function getSectionArray($entities, $type)
    {
        $entity_section = [];
        if (!empty($entities))
            foreach ($entities as $entity) {

                if ($type == Helper::$section_types[1]) {
                    $entity_section['title'] = $entity->benefitLang->title;
                    $entity_section['text'] = $entity->benefitLang->text;
                } else if ($type == Helper::$section_types[2]) {
                    $entity_section['title'] = $entity->qualityLifetLangOne->title;
                    $entity_section['text'] = $entity->qualityLifetLangOne->text;
                } else if ($type == Helper::$section_types[3]) {
                    $entity_section['title'] = $entity->technologyLangOne->title;
                    $entity_section['text'] = $entity->technologyLangOne->text;
                }
            }
        else {
            $entity_section['title'] = '';
            $entity_section['text'] = '';
        }
        return $entity_section;
    }


    public static function getEntityArray()
    {
        $entities = EntityType::orderBy('id', 'asc')->get();

        $entity_arr = [];

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                $entity_arr[$entity->title] = $entity->title;
            }
        }

        return $entity_arr;
    }


    public static function getKeyAreaForMainPage()
    {
        $key_areas_arr = [];

        $i = 1;

        $key_areass = KeysAreaLang::where('lang', Helper::ENG)->take(3)
            ->rightJoin('key_ares', 'key_ares.id', '=', 'keys_area_lang.key_ares_id')
            ->where('status',  Helper::PUBLISHED)
            ->orderBy('keys_area_lang.featured','desc')
            ->orderBy('keys_area_lang.position','desc')
            ->get();

       /* $key_areass = KeyAres::where('status', Helper::PUBLISHED)
            ->with(['keyAreaLangOne' => function ($query) {
                $query->orderBy('position','desc');
                return $query->orderBy('featured','desc');
            }])->get();*/

        if (!empty($key_areass)) {
            foreach($key_areass as $key_areas)
            if (!empty($key_areas)) {
                if (!empty($key_areas)) {
                    $key_areas_arr[$i]['category'] = '';
                    $key_areas_arr[$i]['title'] = $key_areas->title;
                    $key_areas_arr[$i]['text'] = $key_areas->text;
                    $key_areas_arr[$i]['slug'] = $key_areas->slug;
                    $key_areas_arr[$i]['alt'] = $key_areas->alt;
                    $key_areas_arr[$i]['pic_title'] = $key_areas->pic_title;
                    $key_areas_arr[$i]['image'] = $key_areas->keyArea->image;

                    $i++;
                }
            }
        }

        return ($key_areas_arr);

    }


    public static function getEntitiesFront($section_type = 'key_area', $position = 'top',$entity_id)
    {

        $entity_arr = self::getEntityArray();

        $new_entities_arr = [];

        foreach ($entity_arr as $entity_type) {
            /*$entities = TechnologyLang::where('lang', Helper::ENG)
                ->with(['technology' => function ($query) use ($section_type,$position,$entity_type) {
                $query->where('status',  Helper::PUBLISHED);
                    $query->where('section_type',$section_type);
                        $query->where('pos',$position);
                        $query->where('entity_type',$entity_type);
            }])->get();*/

            $entities = Technology::where('status', Helper::PUBLISHED)
                ->where('section_type', $section_type)
                ->where('pos', $position)
                ->where('entity_type', $entity_type)
                ->where('entity_id', $entity_id)
                ->with(['technologyLangOne' => function ($query) use ($section_type, $position, $entity_type) {
                    $query->where('lang', Helper::ENG);
                }])->get();


            if (!empty($entities)) {
                $i = 0;
                foreach ($entities as $entity) {

                    if (!empty($entity->technologyLangOne)) {
                        $new_entities_arr[$entity_type][$i]['title'] = isset($entity->technologyLangOne->title) ? $entity->technologyLangOne->title : '';
                        $new_entities_arr[$entity_type][$i]['text'] = isset($entity->technologyLangOne->text) ? $entity->technologyLangOne->text : '';

                        $new_entities_arr[$entity_type][$i]['alt'] = isset($entity->technologyLangOne->alt) ? $entity->technologyLangOne->alt : '';
                        $new_entities_arr[$entity_type][$i]['pic_title'] = isset($entity->technologyLangOne->pic_title) ? $entity->technologyLangOne->pic_title : '';

                        $new_entities_arr[$entity_type][$i]['image'] = $entity->image;
                        $new_entities_arr[$entity_type][$i]['type'] = $entity->type;
                        $new_entities_arr[$entity_type][$i]['id'] = $entity->id;
                        $new_entities_arr[$entity_type][$i]['section_type'] = $section_type;
                        $new_entities_arr[$entity_type][$i]['entity_type'] = $entity_type;
                        $i++;
                    }
                }
            }

        }


        return $new_entities_arr;
    }

    public static function getSearchResult($search_text='',$searchcat='',$page=1)
    {
        $data=[];

        $start_from = ($page-1) * Helper::PAGE_STEP;

        if(empty($searchcat)) {
            $keys_area = DB::table("keys_area_lang")
                ->select("search_type","slug","keys_area_lang.search_field", "keys_area_lang.title", "keys_area_lang.alt","keys_area_lang.pic_title", 'keys_area_lang.text', 'key_ares.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('key_ares', function ($join) {
                    $join->on('key_ares.id', '=', 'keys_area_lang.key_ares_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                });

            $portfolios = DB::table("portfolio_lang")
                ->select("search_type","slug","portfolio_lang.search_field", "portfolio_lang.title","portfolio_lang.alt","portfolio_lang.pic_title", 'portfolio_lang.text', 'portfolios.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('portfolios', function ($join) {
                    $join->on('portfolios.id', '=', 'portfolio_lang.portfolio_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                });

            $articles = DB::table("articles")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title",'alt','pic_title', 'content as text', 'image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
               ;

            $products = DB::table("products")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title", 'alt','pic_title','text', 'images as image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
            ;

            $use_cases = DB::table("use_cases_lang")
                ->select("search_type","slug","use_cases_lang.search_field", "use_cases_lang.title","use_cases_lang.alt","use_cases_lang.pic_title", 'use_cases_lang.text', 'use_cases.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('use_cases', function ($join) {
                    $join->on('use_cases.id', '=', 'use_cases_lang.use_cases_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->union($keys_area)
                ->union($portfolios)
                ->union($articles)
                ->union($products)
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
                ;

            $data = $use_cases;
        }
        else if($searchcat==Helper::$searchCat['key_areas']){
            $keys_area = DB::table("keys_area_lang")
                ->select("search_type","slug","keys_area_lang.search_field", "keys_area_lang.title","keys_area_lang.alt","keys_area_lang.pic_title", 'keys_area_lang.text', 'key_ares.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('key_ares', function ($join) {
                    $join->on('key_ares.id', '=', 'keys_area_lang.key_ares_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
            ;

            $data = $keys_area;
        }
        else if($searchcat==Helper::$searchCat['projects_portfolio']){
            $portfolios = DB::table("portfolio_lang")
                ->select("search_type","slug","portfolio_lang.search_field", "portfolio_lang.title","portfolio_lang.alt","portfolio_lang.pic_title", 'portfolio_lang.text', 'portfolios.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('portfolios', function ($join) {
                    $join->on('portfolios.id', '=', 'portfolio_lang.portfolio_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
            ;

            $data = $portfolios;
        }
        else if($searchcat==Helper::$searchCat['use_cases']){
            $use_cases = DB::table("use_cases_lang")
                ->select("search_type","slug","use_cases_lang.search_field", "use_cases_lang.title","use_cases_lang.alt","use_cases_lang.pic_title", 'use_cases_lang.text', 'use_cases.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('use_cases', function ($join) {
                    $join->on('use_cases.id', '=', 'use_cases_lang.use_cases_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
            ;

            $data = $use_cases;
        }
        else if($searchcat==Helper::$searchCat['knowledge_base']){
            $articles = DB::table("articles")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title",'alt','pic_title', 'content as text', 'image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
            ;

            $data = $articles;
        }
        else if($searchcat==Helper::$searchCat['catalog']){
            $products = DB::table("products")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title",'alt','pic_title', 'text', 'images as image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->skip($start_from)
                ->take(Helper::PAGE_STEP)
                ->get()
            ;

            $data = $products;
        }

        return $data;

    }

    /* for count*/
    public static function getSearchResultCount($search_text='',$searchcat='')
    {
        $data=[];
        if(empty($searchcat)) {
            $keys_area = DB::table("keys_area_lang")
                ->select("search_type","slug","keys_area_lang.search_field", "keys_area_lang.title", "keys_area_lang.alt","keys_area_lang.pic_title", 'keys_area_lang.text', 'key_ares.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('key_ares', function ($join) {
                    $join->on('key_ares.id', '=', 'keys_area_lang.key_ares_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                });

            $portfolios = DB::table("portfolio_lang")
                ->select("search_type","slug","portfolio_lang.search_field", "portfolio_lang.title", "portfolio_lang.alt","portfolio_lang.pic_title", 'portfolio_lang.text', 'portfolios.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('portfolios', function ($join) {
                    $join->on('portfolios.id', '=', 'portfolio_lang.portfolio_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                });

            $articles = DB::table("articles")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title", 'content as text', 'image','alt','pic_title'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
            ;

            $products = DB::table("products")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title", 'text', 'images','alt','pic_title'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
            ;


            $use_cases = DB::table("use_cases_lang")
                ->select("search_type","slug","use_cases_lang.search_field", "use_cases_lang.title", "use_cases_lang.alt","use_cases_lang.pic_title", 'use_cases_lang.text', 'use_cases.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('use_cases', function ($join) {
                    $join->on('use_cases.id', '=', 'use_cases_lang.use_cases_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->union($keys_area)
                ->union($portfolios)
                ->union($articles)
                ->union($products)
                ->get();

            $data = $use_cases;

        }
        else if($searchcat==Helper::$searchCat['key_areas']){
            $keys_area = DB::table("keys_area_lang")
                ->select("search_type","slug","keys_area_lang.search_field", "keys_area_lang.title", "keys_area_lang.alt","keys_area_lang.pic_title", 'keys_area_lang.text', 'key_ares.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('key_ares', function ($join) {
                    $join->on('key_ares.id', '=', 'keys_area_lang.key_ares_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })->get();

            $data = $keys_area;
        }
        else if($searchcat==Helper::$searchCat['projects_portfolio']){
            $portfolios = DB::table("portfolio_lang")
                ->select("search_type","slug","portfolio_lang.search_field", "portfolio_lang.title", "portfolio_lang.alt","portfolio_lang.pic_title", 'portfolio_lang.text', 'portfolios.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('portfolios', function ($join) {
                    $join->on('portfolios.id', '=', 'portfolio_lang.portfolio_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })->get();

            $data = $portfolios;
        }
        else if($searchcat==Helper::$searchCat['use_cases']){
            $use_cases = DB::table("use_cases_lang")
                ->select("search_type","slug","use_cases_lang.search_field", "use_cases_lang.title", "use_cases_lang.alt","use_cases_lang.pic_title", 'use_cases_lang.text', 'use_cases.image'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->join('use_cases', function ($join) {
                    $join->on('use_cases.id', '=', 'use_cases_lang.use_cases_id')
                        ->where('status', Helper::PUBLISHED);
                    // ->select('key_ares.image');
                })
                ->get();

            $data = $use_cases;
        }
        else if($searchcat==Helper::$searchCat['knowledge_base']){
            $articles = DB::table("articles")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title", 'content as text', 'image','alt','pic_title'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->get();

            $data = $articles;
        }
        else if($searchcat==Helper::$searchCat['catalog']){
            $products = DB::table("products")->where('status', Helper::PUBLISHED)
                ->select("search_type","slug","search_field", "title", 'text', 'images','alt','pic_title'
                )
                ->where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('search_field', 'LIKE', '%' . $search_text . '%')
                ->get()
            ;

            $data = $products;
        }

        return $data;

    }

    public static function createSearchLink($search_type,$slug='')
    {
        $link=[];
        if($search_type=='kea_area'){
            $link['link'] = 'key-areas';
            $link['title'] = 'KEY AREAS';
        }
        else if($search_type=='portfolio'){
            $link['link'] = 'projects-portfolio';
            $link['title'] = 'PROJECTS PORTFOLIO';
        }
        else if($search_type=='use_case'){
            $link['link'] = 'use-cases';
            $link['title'] = 'USE CASES';
        }
        else if($search_type=='catalog'){
            $link['link'] = 'catalog';
            $link['title'] = 'Catalog';
        }
        else if($search_type=='articles'){
            $link['link'] = 'articles';
            $link['title'] = 'KNOWLEDGE BASE';
        }

        return $link;
    }

    public static function searchImage($search_type, $d)
    {
        if (isset($d->image) && $d->image != 'no') {
            if ($search_type == 'catalog') {
                $product = Product::where('status',Product::STATUS_ACTIVE)->where('slug',$d->slug)->first();
                $image = $product->getMainImage()['paths'] ?? '';
        }

            else {
                $image = $d->image;
        }
        } else {
            $image = '';
        }

        return $image;
    }

    public static function checkFile($path)
    {
       /* if(file_exists($path)){
            return true;
        }
        else{
            return false;
        }*/
        $new_path='';
        $is_base64=false;
        if(Helper::is_base64($path)){
            $new_path = Helper::is_base64($path);
            $is_base64=true;
        }
        else{
            $new_path = $path;
        }

        return [
            'path'=>$new_path,
            'is_base64'=>$is_base64
        ];
    }

    public static function is_base64($s)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
    }

    public static function searchAlt($search_type, $d)
    {

            if ($search_type == 'catalog') {
                $product = Product::where('status', Product::STATUS_ACTIVE)->where('slug', $d->slug)->first();
                $alt = $product->getMainImage()['alt'] ?? '';
            }
            else{
                $alt = $d->alt;
            }

        return $alt;
    }

    public static function searchImgTitle($search_type, $d)
    {

        if ($search_type == 'catalog') {
            $product = Product::where('status', Product::STATUS_ACTIVE)->where('slug', $d->slug)->first();
            $title = $product->getMainImage()['title'] ?? '';
        }
        else{
            $title = $d->pic_title;
        }


        return $title;
    }


    public static function getMainImage($image)
    {
        if(!empty($image)) {
            if(is_array($image)) {
                return $image[0];
            } else {
                return json_decode($image)[0];
            }
        }
        return null;
    }

    public static function getImgSrc($src)
    {
        $path='';
        if((isset($src) && $src=='no') || empty($src)){
            $path='';
        }
        else{
            $path=$src;
        }
        return $path;
    }

    public static function createUserCookieId()
    {
        if(!isset($_COOKIE['user_cookie_id'])) {
            $user_cookie_id=$_SERVER['REMOTE_ADDR'].uniqid().time();
            $time = time() + (10 * 365 * 24 * 60 * 60);
            setcookie('user_cookie_id', $user_cookie_id, $time, "/");
        }
        else{
            $user_cookie_id = $_COOKIE['user_cookie_id'];
        }
        return $user_cookie_id;
    }

    public static function getUserCookieId()
    {
        if(!isset($_COOKIE['user_cookie_id'])) {
            $user_cookie_id = Helper::createUserCookieId();
        }
        else{
            $user_cookie_id = $_COOKIE['user_cookie_id'];
        }
        return $user_cookie_id;
    }

    public static function getBgText($bg_text,$title)
    {
        $text='';
        if(!empty($bg_text)){
            $text=$bg_text;
        }
        else{
            $text=$title;
        }
        return $text;
    }

    // for product compare
    public static function getNotEqualField($product,$field,$product_type=null)
    {
        $user_id = Helper::getUserCookieId();

        $not_equal=0;
        $status='not-equal';

        $comparisons = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query) use ($product_type) {
                $query->where('status',  Helper::PUBLISHED);
                if(!empty($product_type)) {
                    $query->where('type', $product_type);
                }
            }])
            ->get();


        $options_arr = Helper::getSortOptions($product);


        $key = array_search($field, array_column($options_arr, 'name'));


       // var_dump($options_arr[$key]['desc']);


        if(!empty($comparisons)){
            foreach($comparisons as $comparison) {
                $product_db = $comparison->product;
                //пока логика наоборот из-за вёрстки
                if (!empty($product_db)) {

                    $options_arr_db = Helper::getSortOptions($product_db);

                    $key_db = array_search($field, array_column($options_arr_db, 'name'));

                    try {
                        if (!empty($options_arr_db) && !empty($options_arr)) {
                            if (isset($options_arr[$key]['desc']) && isset($options_arr_db[$key_db]['desc'])) {
                                if ($options_arr[$key]['desc'] != $options_arr_db[$key_db]['desc']) {
                                    $not_equal = 1;
                                    $status = 'equal';
                                    break;
                                }
                            }
                        }
                    }catch (\Exception $e) {
                        echo $e->getMessage();
                        /*echo "<pre>";
                        print_r($options_arr_db);
                        echo "</pre>";*/

                    }
                }
            }

        }

        return $status;

    }

    // sort
    public static function cmp($a, $b)
    {
        return strcmp($a["name"], $b["name"]);
    }

    public static function getMainOptions($product_type)
    {
        $user_id = Helper::getUserCookieId();
       /* $comparisons = Comparison::where('user_cookie_id',Helper::getUserCookieId())
            ->with(['product' => function ($query)  {
                $query->where('status',  Helper::PUBLISHED);
            }])
            ->get();*/


        $comparisons = Comparison::where('user_cookie_id', Helper::getUserCookieId())
            ->rightJoin('products', 'products.id', '=', 'comparisons.product_id')->where('status', Helper::PUBLISHED)
            ->where('type', $product_type)
            ->get();

        $count_arr=[];

        foreach($comparisons as $comparison) {
            $product_db = $comparison->product;
            if (!empty($product_db)) {
                $options_arr[] = Helper::getSortOptions($product_db);
                //$count_arr['id']=$product_db->id;
                $count_arr[$product_db->id]=count($options_arr);
            }
        }


        $i=1;
        $new_options_arr=[];
        foreach($options_arr as $key=>$op){
        foreach($op as $k=>$options_ar){
            $key = array_search(trim($options_ar['name']), array_column($new_options_arr, 'name'));

            if($key===false) {
                $new_options_arr[$i]['name'] = trim($options_ar['name']);
                $new_options_arr[$i]['desc'] = $options_ar['desc'];
                $i++;
            }
        }
        }

       /* $max = max($count_arr);
        $max_id = array_search($max, $count_arr);
        $product = Product::where('id',$max_id)->first();
        $options_arr = Helper::getSortOptions($product);*/

        return $new_options_arr;
    }

    public static function array_unique_multidimensional($input)
{
    $serialized = array_map('serialize', $input);
    $unique = array_unique($serialized);
    return array_intersect_key($input, $unique);
}

    public static function getSortOptions($product)
    {
        $options = $product->decodeMainInformation();
        $options_arr = json_decode(json_encode($options), true);

        $characteristics = $product->decodeOptionsCharacteristic();
        $characteristics_arr = json_decode(json_encode($characteristics), true);

       // $options_arr = array_merge($options_arr,$characteristics_arr);

        $count =  count($options_arr);

        foreach($characteristics_arr as $characteristics_ar){
            $options_arr[$count]['name']= trim($characteristics_ar['name']);
            $options_arr[$count]['desc']= $characteristics_ar['value']??'not set';
            $count++;
        }
        $count =  count($options_arr);
        //var_dump($count);
        $options_arr[$count]=[
            'name'=>'Price',
            'desc'=>$product->price,
        ];



        usort($options_arr, "Helper::cmp");

        return $options_arr;
    }

    /**
     * @param $bind_item
     * @param $item_ids
     * @return array
     */
    public static function checkItemKeyAndBind($bind_item,$item_ids)
    {
        if(!empty($bind_item) && !empty($item_ids)) $item_ids = array_replace($bind_item,$item_ids);
        if(!empty($bind_item) && empty($item_ids)) $item_ids = $bind_item;

        return $item_ids ;
    }

}
