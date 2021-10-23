<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Articles;
use App\Models\UseCaseLang;
use App\Models\KeysAreaLang;
use App\Models\PortfolioLang;
/**
 * Class BindItems
 * @package App
 */
class BindItems extends Model
{
    public $binds = [];

    /**
     * @return array
     */
    public static function getAllItems()
    {
        $groupedItems = [];
        $modelArticles = Articles::all()->keyBy('id')->pluck('title', 'id')->toArray();
        $modelProduct = Product::all()->keyBy('id')->pluck('title', 'id')->toArray();
        $modelUseCaseLang = UseCaseLang::all()->keyBy('id')->pluck('title', 'id')->toArray();
        $modelKeysAreaLang = KeysAreaLang::all()->keyBy('id')->pluck('title', 'id')->toArray();
        $modelPortfolioLang = PortfolioLang::all()->keyBy('id')->pluck('title', 'id')->toArray();

        $groupedItems[ItemKey::TYPE_ARTICLES] = $modelArticles;
        $groupedItems[ItemKey::TYPE_PRODUCT] = $modelProduct;
//        $groupedItems[ItemKey::TYPE_USE] = $modelUseCaseLang;
//        $groupedItems[ItemKey::TYPE_AREA] = $modelKeysAreaLang;
        $groupedItems[ItemKey::TYPE_PORTFOLIO] = $modelPortfolioLang;

        return $groupedItems;
    }

    /**
     * @param $parent_id
     * @param $parent_type
     * @return bool
     */
    protected function dropAll($parent_id,$parent_type)
    {
        $row = self::where('parent_id',$parent_id)->where('parent_type',$parent_type);
        if(!empty($row)) {
            $row->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $request
     * @return bool
     */
    public function bind($request): bool
    {
        $binds = $request->input('binds');
        $parent_type = $request->input('parent_type');
        $parent_id = $request->input('parent_id');

        if(!empty($binds)) {
            $this->dropAll($parent_id,$parent_type);
            foreach ($binds as $bind) {
                $children_data = $this->parseJsonItem($bind);
                $model = new self();
                $model->parent_id =  $parent_id;
                $model->parent_type =  $parent_type;
                $model->child_id =  $children_data['child_id'];
                $model->child_type =  $children_data['child_type'];
                $model->save();
            }
        } else {
            $this->dropAll($parent_id,$parent_type);
        }
        return true;
    }

    /**
     * @param $item
     * @return array
     */
    protected function parseJsonItem($item)
    {
        $parse = json_decode($item);
        $result = [];
        foreach ($parse as $type => $id) {
            $result['child_type'] = (int)$type;
            $result['child_id'] = $id;
        }
        return $result;
    }

    /**
     * @param $id_entry
     * @param $type_resources
     * @return array
     */
    public  static function getSelectItems($id_entry,$type_resources)
    {
        $result = [];
        $model = new self();
        $row = self::where('parent_id',$id_entry)->where('parent_type',$type_resources)->get();

        foreach ($row as $item) {
            $model_resources = $model->getModelType($item->child_type);
            $child = $model_resources::where('id',$item->child_id)->first();
            if(!empty($child)) {
                $result[$item->child_type][$child->id] = $child->title;
            }
        }
        return $result;
    }


    /**
     * @param $type_resources
     * @return Articles|KeysAreaLang|PortfolioLang|Product|UseCaseLang|null
     */
    public function getModelType($type_resources)
    {
        $model = null;
        switch ($type_resources){
            case ItemKey::TYPE_ARTICLES : $model = new Articles();
                break;
            case ItemKey::TYPE_PRODUCT : $model = new Product();
                break;
            case ItemKey::TYPE_PORTFOLIO : $model = new PortfolioLang();
                break;
            case ItemKey::TYPE_AREA : $model = new KeysAreaLang();
                break;
            case ItemKey::TYPE_USE : $model = new UseCaseLang();
                break;
        }
        return $model;
    }

    /**
     * @param $id_post
     * @param $type_page
     * @param $types
     * @return mixed
     */
    public static function getBindItems($id_post,$type_page,$types)
    {
        return self::where('parent_id',$id_post)
            ->where('parent_type',$type_page)
            ->whereIn('child_type',$types)
            ->pluck('child_id','child_id')
            ->all();
    }
}
