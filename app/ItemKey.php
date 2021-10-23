<?php

namespace App;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\KeysAreaLangRequest;
use App\Http\Requests\PortfolioLangRequest;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\UseCaseLangRequest;
use App\Models\Articles;
use Backpack\NewsCRUD\app\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

/**
 * Class ItemKey
 * @package App
 */
class ItemKey extends Model
{

    const TYPE_ARTICLES = 1;
    const TYPE_AREA = 2;
    const TYPE_USE = 3;
    const TYPE_PRODUCT = 4;
    const TYPE_PORTFOLIO = 5;
    const TYPE_CATEGORIES = 6;

    protected $table = 'item_keys';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [];

    /**
     * @param $request ArticleRequest|KeysAreaLangRequest|PortfolioLangRequest|ProductsRequest|UseCaseLangRequest|\App\Http\Requests\CategoryRequest
     * @param $type integer
     */
    public function setKeyAndItem($request,$type = 0)
    {
        $self_id = $request->input('id');
        $this->deleteItem($self_id,$type);
        if(!empty($key_ids = $request->input('key_id'))) {
            foreach ($key_ids as $id_key) {
                $model = new self();
                $model->item_id = $self_id;
                $model->key_id = $id_key;
                $model->type = $type;
                $model->save();
            }
        }
    }

    /**
     * @param $item_id integer
     * @param $type integer
     * @return mixed
     */
    protected function deleteItem($item_id,$type)
    {
        $row = self::where('item_id',$item_id)->where('type',$type);
        if(!empty($row)) {
            $row->delete();
            return true;
        }
        return false;
    }

    /**
     * @param $type
     * @return string
     */
    public static function getNameType($type)
    {
        $types = [
            self::TYPE_ARTICLES => 'Articles',
            self::TYPE_PORTFOLIO => 'Portfolio',
            self::TYPE_USE => 'Use Cases',
            self::TYPE_AREA => 'Keys Area',
            self::TYPE_PRODUCT => 'Products',
            self::TYPE_CATEGORIES => 'Categories',
        ];
        return $types[$type];
    }

    /**
     * @param $table
     * @return int
     */
    public static function getTypeSection($table)
    {
        $types = [
            'articles' => self::TYPE_ARTICLES,
            'portfolio_lang' => self::TYPE_PORTFOLIO,
            'use_cases_lang' => self::TYPE_USE,
            'keys_area_lang' => self::TYPE_AREA,
            'categories' => self::TYPE_CATEGORIES,
        ];

        return $types[$table->getTable()];
    }

    /**
     * @param $keys array
     * @param $types array
     * @return mixed
     */
    public static function getItemsByKey(array $keys, array $types)
    {
        return self::whereIn('key_id',$keys)->whereIn('type',$types)->pluck('item_id', 'item_id')
            ->all();
    }

    /**
     * @param $item_id
     * @param null $type
     * @return array
     */
    public function getKeysByItemId($item_id,$type = null) : array
    {
        if(!empty($type)) {
            if($type != self::TYPE_PRODUCT) {
                $item = ItemKey::where('item_id',$item_id)->where('type',$type)
                    ->pluck('key_id', 'key_id')->toArray();
            } else {
                $item = ProductKey::where('products_id',$item_id)
                    ->pluck('keys_id', 'keys_id')->toArray();
            }
            if(!empty($item)) {
                return $item;
            }
            return [];
        }
        return [];
    }
}
