<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Tags
 * @package App
 */
class Tags extends Model
{
    /**
     * @param $tag_ids
     * @return Collection
     */
    public static function getArticleIds($tag_ids): Collection
    {
        return ArticleTag::all()->whereIn('tag_id',$tag_ids)->pluck('articles_id','articles_id');
    }
}
