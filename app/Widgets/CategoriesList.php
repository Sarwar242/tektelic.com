<?php

namespace App\Widgets;

use App\Categories;
use App\Models\Category;
use App\Models\Keys;
use Arrilot\Widgets\AbstractWidget;

class CategoriesList extends AbstractWidget
{
    const TYPE_AREA = 1;
    const TYPE_USE = 2;
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'category',
        'category_slug'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $categoriesArea = Category::where('key_id',self::TYPE_AREA)->get();
        $categoriesUse = Category::where('key_id',self::TYPE_USE)->get();
        return view('widgets.categories_list', [
            'config' => $this->config,
            'categoriesArea' => $categoriesArea,
            'categoriesUse' => $categoriesUse,
            'categories' => $this->config['categories'],
            'category_slug' => $this->config['category_slug']
        ]);
    }
}
