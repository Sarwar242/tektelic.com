<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use CrudTrait;
    const TYPE_USE = 1;
    const TYPE_KEY = 2;
    const TYPE_CATALOG = 3;
    const TYPE_DIST = 4;
    const TYPE_NEWS = 5;
    const TYPE_PORT = 6;
    const TYPE_ABOUT = 7;
    const TYPE_WHITEPAPER = 8;

    protected $table = 'menu_items';
    protected $fillable = ['title', 'type', 'link', 'page_id','type_page','parent_id','pos','position','set_crumbs'];

    public static $types = [
        self::TYPE_USE => 'Use Cases',
        self::TYPE_KEY => 'Key Area',
        self::TYPE_CATALOG => 'Catalog',
        self::TYPE_DIST => 'Distributors',
        self::TYPE_NEWS => 'Knowledge Base',
        self::TYPE_PORT => 'Portfolio',
        self::TYPE_ABOUT => 'About Us',
        self::TYPE_WHITEPAPER => 'White Paper',
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuItem', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\MenuItem', 'parent_id');
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
    }

    /**
     * Get all menu items, in a hierarchical collection.
     * Only supports 2 levels of indentation.
     */
    public static function getTree()
    {
        $menu = self::orderBy('lft')->get();

        if ($menu->count()) {
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);

                foreach ($menu as $i => $menu_subitem) {
                    if ($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }

        return $menu;
    }

    public static function getTreeFront($pos='top')
    {
        $menu = self::orderBy('lft')->where('pos',$pos)->orderBy('position','asc')->get();

        if ($menu->count()) {
            foreach ($menu as $k => $menu_item) {
                $menu_item->children = collect([]);

                foreach ($menu as $i => $menu_subitem) {
                    if ($menu_subitem->parent_id == $menu_item->id) {
                        $menu_item->children->push($menu_subitem);

                        // remove the subitem for the first level
                        $menu = $menu->reject(function ($item) use ($menu_subitem) {
                            return $item->id == $menu_subitem->id;
                        });
                    }
                }
            }
        }

        return $menu;
    }

    public function url()
    {
        switch ($this->type) {
            case 'external_link':
                return $this->link;
                break;

            case 'internal_link':
                return is_null($this->link) ? '#' : url($this->link);
                break;

            default: //page_link
                if ($this->page) {
                    return url($this->page->slug);
                }
                break;
        }
    }

    /**
     * @param null $type
     * @return null
     */
    public function getDataNameByTypePage($type = null)
    {
        if($type) {
            $item = self::where('type_page',$type)->first();
            if(!empty($item)) {
                return $item->title;
            }
        }
        return null;
    }
}
