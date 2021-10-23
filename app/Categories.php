<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Category;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categories
 * @package App
 */
class Categories extends Category
{
    use CrudTrait;

    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolios');
    }

    /**
     * @param bool $asArray
     * @return array
     */
    public static function getCategories($asArray = false)
    {

        if($asArray) {
            return self::all()->keyBy('id')->pluck('name', 'id')->toArray();
        } else {
            return self::all();
        }
    }

    /**
     * @param $slug
     * @return Categories|Categories[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public static function getCategoryBySlug($slug)
    {
        return self::findBySlug($slug);
    }

    /**
     * @param $slug
     * @param array $types
     * @return array
     */
    public function getCategoryKeysBySlug($slug,$types = []) : array
    {
        $category = self::getCategoryBySlug($slug);
        if(!empty($category)) {
            return $this->prepareKeys($category,$types);
        }
        return [];
    }

    /**
     * @param $category
     * @param $types
     * @return mixed
     */
    protected function prepareKeys($category,$types)
    {
        $serviceItem = new ItemKey();
        $category_id = $category->id;
        $type_category = ItemKey::TYPE_CATEGORIES;
        if(in_array(ItemKey::TYPE_PRODUCT,$types)) {
            $keys = $serviceItem->getKeysByItemId($category_id,$type_category);
            return ProductKey::getItemsByKey($keys);
        } else {
            $keys = $serviceItem->getKeysByItemId($category_id,$type_category);
            return ItemKey::getItemsByKey($keys,$types);
        }
    }

    /**
     * @param $ids
     * @param $types
     * @return array|mixed
     */
    public function getKeyByIds($ids,$types): array
    {
        foreach ($ids as $id) {
            $category = Category::find($id);
            return $this->prepareKeys($category,$types);
        }
        return [];
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getCategoryKeysByIdsProduct($ids)
    {
        $serviceItem = new ItemKey();
        $keys_result = [];
        foreach ($ids as $id) {
            $keys = $serviceItem->getKeysByItemId($id,ItemKey::TYPE_CATEGORIES);
            foreach ($keys as $key) {
                $keys_result[$key] = $key;
            }

        }
        return ProductKey::getItemsByKey($keys_result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getCategoryById($id)
    {
        return self::find($id);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return Keys::where('id',$this->key_id)->first();
    }

}


