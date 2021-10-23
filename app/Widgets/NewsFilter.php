<?php

namespace App\Widgets;

use App\Articles;
use App\KeysAreaLang;
use App\Models\Category;
use App\Models\Tag;
use App\Product;
use App\UseCaseLang;
use Arrilot\Widgets\AbstractWidget;

class NewsFilter extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'type'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $tags = Tag::all();
        $categoriesArea = KeysAreaLang::all()->keyBy('id')->pluck('title', 'id')->toArray();
        $categoriesUse = UseCaseLang::all()->keyBy('id')->pluck('title','id')->toArray();
        $lastArticles = Articles::getLastArticles(5);
        $checkedItems = $this->getActiveFilter();
        return view('widgets.news_filter', [
            'config' => $this->config,
            'tags' => $tags,
            'categoriesArea' => $categoriesArea,
            'categoriesUse' => $categoriesUse,
            'lastArticles' => $lastArticles,
            'type' => $this->config['type'],
            'checkedItems' => $checkedItems

        ]);
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
