<?php

namespace App;

use App\Exceptions\Helpers;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\ProductCharacteristics;
use App\Models\ProductLinkCharacteristics;
use App\Widgets\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends \App\Models\Products
{
    /*
   |--------------------------------------------------------------------------
   | GLOBAL VARIABLES
   |--------------------------------------------------------------------------
   */
    const STATUS_ACTIVE = 1;
    const STATUS_NO_ACTIVE = 0;

    const TYPE_SORT_UP = 1;
    const TYPE_SORT_DOWN = 2;

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;


    public static $statuses =[
        1=>'yes',
        2=>'no'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @param int $take
     * @param null $category_id
     * @param false $getQuery
     * @param int $status
     * @param false $featured
     * @param bool $position
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getProducts(
        $category_id = null,$getQuery = false,$status = self::STATUS_ACTIVE,$featured = false , $position = true)
    {
        /** @var Builder $query */
        $query = self::where('status',$status);
        if(!is_null($category_id)) {
//            $query->where('category_id',$category_id);
            $query->limit(4);
        }
        if($featured) {
            $query->orderBy('featured','desc');
        }
        if($position) {
            $query->orderBy('position','desc');
        }
        return $getQuery ? $query : $query->get();
    }

    /**
     * @return string|null
     */
    public function getImages()
    {
        if(!empty($this->images)) {
            return $this->images;
        }
        return null;
    }

    /**
     * @return string|null
     */
    public function getMainImage()
    {
        if(!empty($this->images)) {
            if(isset($this->images[0]['paths'])) {
                if(is_string($this->images[0]['paths'])) {
                    return $this->images[0];
                }
            }
        }
        return null;
    }

    /**
     * @return array|null
     */
    public function decodeMainInformation()
    {
        if(!empty($this->options)) {
            return (array)json_decode($this->options);
        }
        return [];
    }

    /**
     * @param null $options
     * @return array
     */
    public function decodeOptionsCharacteristic($options = null)
    {
        if(empty($options)) {
            if(!empty($this->options_characteristics)) {
                return (array)json_decode($this->options_characteristics);
            }
        } else {
            return (array)json_decode($options);
        }

        return [];
    }

    /**
     * @param $options
     * @return array[]
     */
    public function getIdsCharacteristic($options = null)
    {
        $ids = [];
        $values = [];
        if(!empty($options)) {
            $data = $options;
        } else {
            $data = $this->decodeOptionsCharacteristic();
        }
        foreach ($data as $datum) {
            $ids[$datum->id] = $datum->id;
        }
        foreach ($data as $datum) {
            if(isset($datum->name)) {
               // $name = $datum->name;
                $name = $datum->value;
            } else {
                $name = $datum->value;
            }
            $values[$datum->id] = $name;
        }
        return [
            'ids' => $ids,
            'values' => $values
        ];
    }

    /**
     * @param $slug
     * @return Articles[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBySlug($slug)
    {
        return self::where('status',self::STATUS_ACTIVE)->where('slug',$slug)->first();
    }

    /**
     * @param $keys
     * @param $id_post
     * @param array $types
     * @param $type_page array
     * @return mixed
     */
    public static function getProductsTypeKey($keys,$id_post,$types = [],$type_page = [])
    {
        $bind_item = BindItems::getBindItems($id_post,$type_page,$types);

        if(in_array(ItemKey::TYPE_PRODUCT,$types)) {
            $item_ids = ProductKey::getItemsByKey($keys);
        } else {
            $item_ids = ItemKey::getItemsByKey($keys,$types);
        }
        $result_ids = Helper::checkItemKeyAndBind($bind_item,$item_ids);
        $rows = self::whereNotIn('id',[$id_post])->where('status',Product::STATUS_ACTIVE);
        $rows->whereIn('id',$result_ids);
        if(!empty($bind_item)) {
            $ids_ordered = implode(',', $result_ids);
            $rows->orderByRaw("FIELD(id,$ids_ordered)");
        }
        return $rows->take(4)->get();
    }

    /**
     * @return mixed
     */
    public function getTypeKeyCategory()
    {
        return Categories::getCategoryById($this->category_id)->key()->type();
    }

    /**
     * @return array
     */
    public function getCharacteristics()
    {
        $characteristics = [];

//        $product_id = $this->id;
//        $rowCharacteristic = ProductLinkCharacteristics::where('products_id',$product_id)->get();
//        $rowCharacteristic = ProductLinkCharacteristics::whereIn('product_characteristics_id',$ids)->get();;
        $data = $this->getIdsCharacteristic();

        $rowCharacteristic = ProductCharacteristics::whereIn('id',$data['ids'])->get();
        foreach ($rowCharacteristic as $item)
        {
            if(!empty($item->parent)) {
                if($item->parent->is_main) {
                    $characteristics['main'][$item->parent->title][$item->id]['name'] = $item->name;
                } else {
                    $checked = 0;
                    if($data['values'][$item->id] == 'on') $checked = 1;
                    if($data['values'][$item->id] == 'off') $checked = 0;
                    $characteristics['base'][$item->parent->title][$item->id]['name'] = $item->name;
                    $characteristics['base'][$item->parent->title][$item->id]['value'] = $data['values'][$item->id];
                    $characteristics['base'][$item->parent->title][$item->id]['checked'] = $checked;
                }
            }
        }
        return $characteristics;

    }

    /**
     * @param $drops
     * @param $named
     * @return array
     */
    protected function dropItemStringFilter($drops,$named)
    {
        $result = [];
        foreach ($drops as $item) {
            if(!empty($item)) {
                $item = str_replace('[','',$item);
                $item = str_replace(']','',$item);
                $item_ids = explode('-',$item);
                foreach ($item_ids as $item_id)
                    $result[$item_id]=$item_id;
            }
        }
        return $result;
    }

    /**
     * @param $filters
     * @return array
     */
    public static function parseFilterString($filters)
    {
        $model = new self();
        $filter_result_ids = [];
        $drop_categories = [];
        $drop_types = [];
        $drop_tags = [];
        $drop_key = [];
        $drop_use = [];
        if(!empty($filters)) {
            $drop_parent = explode('|',$filters);
            foreach ($drop_parent as $key => $item) {
                if ( preg_match("~\btype\b~",$item) ) {
                    $drop_types = explode('type',$item);
                } elseif( preg_match("~\bcategories\b~",$item) ) {
                    $drop_categories = explode('categories',$item);
                } elseif( preg_match("~\btags\b~",$item) ) {
                    $drop_tags = explode('tags',$item);
                } elseif( preg_match("~\buse\b~",$item) ) {
                    $drop_use = explode('use',$item);
                } elseif( preg_match("~\bkey\b~",$item) ) {
                    $drop_key = explode('key',$item);
                }

            }
            $filter_result_ids['filters']['result_category'] = $model->dropItemStringFilter($drop_categories,'categories');
            $filter_result_ids['filters']['result_type'] = $model->dropItemStringFilter($drop_types,'types');
            $filter_result_ids['filters']['result_tags'] = $model->dropItemStringFilter($drop_tags,'tags');
            $filter_result_ids['filters']['result_key'] = $model->dropItemStringFilter($drop_key,'key');
            $filter_result_ids['filters']['result_use'] = $model->dropItemStringFilter($drop_use,'use');
        }
        return $filter_result_ids;
    }

    /**
     * @param $result
     * @param $currentPage int
     * @return string
     */
    public static function generateUrlForFilter($result,$currentPage = 1)
    {
        $url_array = [];
        $url_string = '';
        $model = new self();
        $status = false;
        $is_catalog = false;

        if(!empty($result)) {
            $name_data = $model->parseDataFilterIds($result);
            if(!empty($name_data['result_category_area'])) {
                foreach ($name_data['result_category_area'] as $id_area) {
                    if($id_area != 0) {
                        $item = KeysAreaLang::where('id',$id_area)->first();
                        $url_array['category_area'][$item->id] = $item->id;
                    }
                }
            }
            if(!empty($name_data['result_category_use'])) {
                foreach ($name_data['result_category_use'] as $id_use) {
                    if($id_use != 0) {
                        $item = UseCaseLang::where('id',$id_use)->first();
                        $url_array['category_use'][$item->id] = $item->id;
                    }
                }
            }
            if(!empty($name_data['result_category'])) {
                $is_catalog = true;
                foreach ($name_data['result_category'] as $id_category) {
                    if($id_category != 0) {
                        $category = Categories::where('id',$id_category)->first();
                        $url_array['category'][$category->id] = $category->id;
                    }
                }
            }
            if(!empty($name_data['result_category_articles'])) {
                foreach ($name_data['result_category_articles'] as $id_category) {
                    if($id_category != 0) {
                        $category = Categories::where('id',$id_category)->first();
                        $url_array['category_articles'][$category->id] = $category->id;
                    }
                }
            }
            if(!empty($name_data['result_tag'])) {
                foreach ($name_data['result_tag'] as $id_tag) {
                    if($id_tag != 0) {
                        $tag = Tags::where('id',$id_tag)->first();
                        $url_array['tag'][$tag->id] = $tag->id;
                    }
                }
            }
            if(!empty($name_data['result_type'])) {
                $is_catalog = true;
                foreach ($name_data['result_type'] as $type_id) {
                    $productType = ProductType::where('id',$type_id)->first();
                    $url_array['type'][$productType->id] = $productType->id;
                }
            }

            $url_string = "articles?filters=";
            if($is_catalog) {
                $url_string = "catalog?filters=";
            }

            if(isset($url_array['category']) && !empty($url_array['category'])) {
                $status = true;
                $url_string .= 'categories['.implode('-',$url_array['category']).']|';
            }
            if(isset($url_array['category_articles']) && !empty($url_array['category_articles'])) {
                $status = true;
                $url_string .= 'categories['.implode('-',$url_array['category_articles']).']|';
            }
            if(isset($url_array['type']) && !empty($url_array['type'])) {
                $status = true;
                $url_string .= 'type['.implode('-',$url_array['type']).']|';
            }
            if(isset($url_array['tag']) && !empty($url_array['tag'])) {
                $status = true;
                $url_string .= 'tags['.implode('-',$url_array['tag']).']|';
            }
            if(isset($url_array['category_area']) && !empty($url_array['category_area'])) {
                $status = true;
                $url_string .= 'key['.implode('-',$url_array['category_area']).']|';
            }
            if(isset($url_array['category_use']) && !empty($url_array['category_use'])) {
                $status = true;
                $url_string .= 'use['.implode('-',$url_array['category_use']).']|';
            }
            if($currentPage > 1) {
                $status = true;
                $url_string .= '&page='.$currentPage;
            }
//            if(!empty($name_data)) {
//                $products->whereBetween('price',[$rangeData['first_range'],$rangeData['second_range']]);
//            }
            if($status) {
                return $url_string;
            } else {
                if(empty($url_array)) {
                    if($is_catalog) {
                        return 'catalog';
                    } else {
                        return 'articles';
                    }
                }
            }
        }
        return $url_string;
    }

    /**
     * @param $products Builder|query
     * @param $result
     * @return mixed
     */
    public static function filterData($products,$result)
    {
        $model = new self();
        $modelCategory = new Categories();
        if(!is_null($result)) {
            $rangeData = $model->rangeData($result);
            $result = $model->parseDataFilterIds($result);
            if(!empty($result['result_category'])) {
                if(!in_array('all',$result['result_category'])) {
                    $item_ids = $modelCategory->getCategoryKeysByIdsProduct($result['result_category']);
                    $products->whereIn('id',$item_ids);
                }
            }
            if(!empty($result['result_type'])) {
                $products->whereIn('type',$result['result_type']);
            }
            if(!empty($rangeData)) {
                $products->whereBetween('price',[$rangeData['first_range'],$rangeData['second_range']]);
            }
            if(!empty($result['result_characteristic'])) {
                $modelFilter = new ProductFilter();
                $data = $modelFilter->getCharacteristicsIds($products,true);
                $product_ids = [];
                if(!empty($data)) {
                    foreach ($data as $id_product => $datum) {
                        $product_ids[$id_product] = $id_product;
                    }
                }
                /*$product_ids = ProductLinkCharacteristics::whereIn('product_characteristics_id',
                    $result['result_characteristic'])
                    ->pluck('products_id', 'products_id')
                    ->toArray();*/
                $products->whereIn('id',$product_ids);
            }
        }

        return $products;
    }

    /**
     * @param $data
     * @return array
     */
    protected function rangeData($data)
    {
        $result = [];
        foreach ($data as $datum) {
            if($datum['name'] == 'first_range') {
                $result['first_range'] = $datum['value'] ?? 0;
            }
            if($datum['name'] == 'second_range') {
                $result['second_range'] = $datum['value'] ?? 20000;
            }
        }

        return $result;
    }

    /**
     * @param $data
     * @return array
     */
    protected function parseDataFilterIds($data): array
    {
        $result_tag = [];
        $result_type = [];
        $result_category = [];
        $result_characteristic = [];
        $result_category_area = [];
        $result_category_use = [];
        $result_category_articles = [];
        if(is_array($data)) {
            foreach ($data as $datum) {
                $key = $datum['value'];
                if($datum['name'] == 'category') $result_category[$datum['value']] = $key;
                if($datum['name'] == 'category_use') $result_category_use[$datum['value']] = $key;
                if($datum['name'] == 'category_area') $result_category_area[$datum['value']] = $key;
                if($datum['name'] == 'category_articles') $result_category_articles[$datum['value']] = $key;
                if($datum['name'] == 'type') $result_type[$datum['value']] = $key;
                if($datum['name'] == 'tag') $result_tag[$datum['value']] = $key;
                if($datum['name'] == 'characteristic') $result_characteristic[$datum['value']] = $key;
            }
            return [
                'result_category' => $result_category,
                'result_type' => $result_type,
                'result_characteristic' => $result_characteristic,
                'result_tag' => $result_tag,
                'result_category_use' => $result_category_use,
                'result_category_area' => $result_category_area,
                'result_category_articles' => $result_category_articles
            ];
        }
        return [];
    }

    /**
     * @param $products Builder|query
     * @param $sort_type
     * @return Builder|Product|query
     */
    public static function sortByData(Builder $products, $sort_type)
    {
        if(self::TYPE_SORT_UP == $sort_type) {
            $products->getQuery()->orders = null;
            $products->orderBy('title', 'DESC');
        } else if(self::TYPE_SORT_DOWN == $sort_type) {
            $products->getQuery()->orders = null;
            $products->orderBy('title', 'ASC');
        }
        return $products;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
