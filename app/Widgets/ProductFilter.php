<?php

namespace App\Widgets;

use App\Categories;
use App\Models\ProductCharacteristics;
use App\Models\ProductLinkCharacteristics;
use App\Models\ProductTypeItemFilter;
use App\Product;
use App\ProductType;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Session;

class ProductFilter extends AbstractWidget
{
    const TYPE_SORT  = 'sort';
    const TYPE_FILTER = 'filter';
    const TYPE_RANGE = 'range';
    /**
     * The configuration array.
     *
     * @var array
     */

    protected $config = [
        'products',
        'class'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $modelType = new ProductType();
        $characteristics = $this->GetArrayCharacteristics();
        $checkedItems = $this->getActiveFilter();
        $this->setSessionData();
        return view('widgets.product_filter', [
            'config' => $this->config,
            'types' => $modelType->getTypes(),
            'categories' => Categories::getCategories(true),
            'characteristics' => $characteristics,
            'checkedItems' => $checkedItems,
            'class' => $this->config['class']
        ]);
    }


    /**
     * save data for filter in session
     * @return void
     */
    protected function setSessionData()
    {
        Session::put('products', Product::get());
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getNameGroup($type): bool
    {
        $data = ProductTypeItemFilter::where('id',$type)->first();
        if(!empty($data))
            return $data->name;
        return true;
    }

    /**
     * @param null $products
     * @param false $with_id_product
     * @return array
     */
    public function getCharacteristicsIds($products = null,$with_id_product = false): array
    {
        $characteristics= [];
        $ids = [];
        $model = new Product();

        $items = Product::get();
        if(!empty($items)) {
            foreach ($items as $product) {
                if(!empty($product->options_characteristics)) {
                    $data = $model->getIdsCharacteristic(
                        $model->decodeOptionsCharacteristic($product->options_characteristics)
                    );
                    if($with_id_product) $characteristics[$product->id] = $data; else $characteristics[] = $data;
                }
            }

            foreach ($characteristics as $characteristic) {
                foreach ($characteristic['ids'] as $id) {
                    $ids[$id] = $id;
                }
            }

            if($with_id_product) return $characteristics; else return $ids;
        }
        return [];

    }


    /**
     * @return array
     */
    protected function GetArrayCharacteristics(): array
    {
        $result = [];

        $ids = $this->getCharacteristicsIds();
//        $items = ProductLinkCharacteristics::whereIn('products_id',$products_ids)->get();
        if(!empty($ids)) {
            $items = ProductCharacteristics::whereIn('id',$ids)->get();
            foreach ($items as $item) {
                if($item->set_to_filter == 1) {
                    $result[$item->type_filter][$item->id]['id'] = $item->id;
                    $result[$item->type_filter][$item->id]['name'] = $item->name;
                    $result[$item->type_filter][$item->id]['value'] = $item->value;
                }
            }
            return $result;
        }
        return [];
    }

    /**
     * @return string
     */
    public function placeholder()
    {
        return 'Loading...';
    }

    /**
     * @return array|mixed
     */
    public function getActiveFilter()
    {
        $data = isset($_GET['filters']) ? $_GET['filters'] : [];
        if(!empty($data)) {
            return Product::parseFilterString($data)['filters'];
        }
        return [];
    }
}
