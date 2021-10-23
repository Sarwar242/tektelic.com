<?php

namespace App;

use App\Helpers\Helper;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

/**
 * Class News
 * @package App
 */
class Articles extends \App\Models\Articles
{
    const STATUS_PUBLISHED = 'PUBLISHED';
    protected $table = 'articles';

    /**
     * @param int $take
     * @param int $category_id
     * @param int $position
     * @param boolean $getQuery
     * @param boolean $featured
     * @param string $status
     * @return Articles[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getArticles(
        $category_id = null,$getQuery = false,$status = self::STATUS_PUBLISHED,$featured = false,$position = true
    )
    {
        $query = self::where('status',$status);
        if(!is_null($category_id)) {
//            $query->where('category_id',$category_id);
        }
        if($featured) {
            $query->orderBy('featured','desc');
        }
        if($position) {
            $query->orderBy('position','desc');
        }
        $query->orderBy('date','desc');
        return $getQuery ? $query : $query->get();
    }

    /**
     * @param $posts
     * @param $result
     * @return mixed
     */
    public static function filterData($posts,$result)
    {
        $model = new self();
        $modelCategory = new Categories();
        $result = $model->parseDataFilter($result);
        if(!empty($result)) {
            if(!empty($result['result_category_articles'])) {
                if(!in_array('all',$result['result_category_articles'])) {
                    $item_ids = $modelCategory->getCategoryKeysByIdsProduct($result['result_category_articles']);
                    $posts->whereIn('id',$item_ids);
                }
            }
            if(!empty($result['result_category_use']))
                $posts = $model->filterByCategories($result['result_category_use'],$posts,ItemKey::TYPE_USE);
            if(!empty($result['result_category_area']))
                $posts = $model->filterByCategories($result['result_category_area'],$posts,ItemKey::TYPE_AREA);
            if(!empty($result['result_tag']))
                $posts = $model->getPostQueryByTag($posts,$result['result_tag']);
        }
        return $posts;
    }

    /**
     * @param $items
     * @param $posts
     * @param $type
     * @return array
     */
    public function filterByCategories($items,$posts,$type)
    {
        $keys = [];
        $modelKeys = new ItemKey();
        foreach ($items as $item_id) {
            $keys = $modelKeys->getKeysByItemId($item_id,$type);
        }
        if(!empty($keys)) {
            $article_ids = $modelKeys->getItemsByKey($keys,[$modelKeys::TYPE_ARTICLES]);
            $posts->whereIn('id',$article_ids);
        }
        return $posts;
    }

    /**
     * @param $posts
     * @param $tag_ids
     * @return mixed
     */
    public function getPostQueryByTag($posts,$tag_ids)
    {
        $article_ids = Tags::getArticleIds($tag_ids);
        return $posts->whereIn('id',$article_ids);
    }

    /**
     * @param $data
     * @return array
     */
    protected function parseDataFilter($data): array
    {
        $result_category_articles = [];
        $result_category_area = [];
        $result_category_use = [];
        $result_tag = [];
        if(!is_null($data)) {
            foreach ($data as $datum) {
                if($datum['name'] == 'category_use')
                    $result_category_use[$datum['value']] = $datum['value'];
                if($datum['name'] == 'category_articles')
                    $result_category_articles[$datum['value']] = $datum['value'];
                if($datum['name'] == 'category_area')
                    $result_category_area[$datum['value']] = $datum['value'];
                if($datum['name'] == 'tag')
                    $result_tag[$datum['value']] = $datum['value'];
            }
        }
        return [
            'result_category_area' => $result_category_area,
            'result_category_use' => $result_category_use,
            'result_tag' => $result_tag,
            'result_category_articles' => $result_category_articles
        ];
    }


    /**
     * @param $keys
     * @param $id_post
     * @param $types array
     * @param $type_page array
     * @return mixed
     */
    public static function getArticlesTypeKey($keys,$id_post,$types = [],$type_page = [])
    {
        $bind_item = BindItems::getBindItems($id_post,$type_page,$types);
        $item_ids = ItemKey::getItemsByKey($keys,$types);
        $result_ids = Helper::checkItemKeyAndBind($bind_item,$item_ids);
        $rows =  self::whereNotIn('id',[$id_post])
            ->where('status',Articles::STATUS_PUBLISHED)
            ->whereIn('id',$result_ids);
        if(!empty($bind_item)) {
            $ids_ordered = implode(',', $result_ids);
            $rows->orderByRaw("FIELD(id,$ids_ordered)");
        }
        return $rows->take(4)->get();
    }

    /**
     * @param $slug
     * @return Articles[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getArticleBySlug($slug)
    {
        return self::where('status',self::STATUS_PUBLISHED)->where('slug',$slug)->first();
    }

    /**
     * @param int $take
     * @return mixed
     */
    public static function getLastArticles($take = 5)
    {
        return self::latest('created_at')->where('featured',1)->take($take)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getArticleLang()
    {
        return $this->hasOne('App\ArticlesLang');
    }

    /**
     * @return mixed
     */
    public function getTypeKeyCategory()
    {
        return Categories::getCategoryById($this->category_id)->key()->type();
    }

    /**
     * @param $article_id
     * @return mixed
     */
    public static function getTagsPost($article_id)
    {
        $article_tag = ArticleTag::where('articles_id',$article_id)->first();
        if(!empty($article_tag)) {
            return Tags::where('id',$article_tag->tag_id)->get();
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getFeatureArticles()
    {
        return self::where('featured',1)->take(4)->get();
    }
}
