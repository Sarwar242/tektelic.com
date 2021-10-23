<?php

namespace App;

use App\Helpers\Helper;
use App\Models\PortfolioLang;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Portfolio
 * @package App
 */
class Portfolio extends Model
{
    protected $table = 'portfolio';

    /**
     * @param $keys
     * @param $id_post
     * @param array $types
     * @param $type_page array
     * @return mixed
     */
    public static function getPortfoliosTypeKey($keys,$id_post,$types = [],$type_page = [])
    {
        $bind_item = BindItems::getBindItems($id_post,$type_page,$types);
        $item_ids = ItemKey::getItemsByKey($keys,$types);
        $result_ids = Helper::checkItemKeyAndBind($bind_item,$item_ids);

        $rows = PortfolioLang::where('lang', Helper::ENG)
            ->whereNotIn('id',[$id_post])
            ->whereIn('id',$result_ids);
        if(!empty($bind_item)) {
            $ids_ordered = implode(',', $result_ids);
            $rows->orderByRaw("FIELD(id,$ids_ordered)");
        }
        $rows->with(['portfolio' => function ($query){
                $query->where('status',  Helper::PUBLISHED);
            }]);
        return $rows->take(4)->get();
    }


    /**
     * @return mixed
     */
    public static function getPortfoliosWithLang()
    {
        return PortfolioLang::with(['portfolio' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->orderBy('created_at','desc')->get();
    }

    /**
     * @param $result_id
     * @return mixed
     */
    protected static function getPortfoliosWithIds($result_id)
    {
        return PortfolioLang::where('lang', Helper::ENG)->whereIn('portfolio_id',$result_id)->with(['portfolio' => function ($query) {
            $query->where('status',  Helper::PUBLISHED);
        }])->orderBy('created_at','desc')->get();
    }


    /**
     * @param $category
     * @param int $take
     * @return mixed
     */
    public static function getPortfolios($category,$take = 4)
    {
       /* return \App\PortfolioLang::where('lang', Helper::ENG)->with(['portfolio' => function ($query) use($category) {
            $query->where('status',  Helper::PUBLISHED);
            if(!empty($category)){
                $query->where('category_id',$category->id);
            }
        }])->take($take)->get();*/
        $portfolio = PortfolioLang::where('lang', Helper::ENG)
            ->rightJoin('portfolios', 'portfolios.id', '=', 'portfolio_lang.portfolio_id')->where('status',  Helper::PUBLISHED)
            ->where('category_id',  $category)
            ->take($take)
            ->get();
        return $portfolio;
    }
}
