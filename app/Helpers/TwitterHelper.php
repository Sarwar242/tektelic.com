<?php

namespace App\Helpers;


use App\Comparison;
use App\Models\Articles;
use App\Models\BenefitLang;
use App\Models\Category;
use App\Models\CountryLang;
use App\Models\EntityType;
use App\Models\KeyAres;
use App\Models\KeysAreaLang;
use App\Models\QualityLifesLang;
use App\Models\Technology;
use App\Models\TechnologyLang;
use App\Models\UseCaseLang;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class TwitterHelper
{

    // saving articles from api
    public static function saveApiArticles($text,$image_link,$id,$created_at,$title)
    {
        $article = Articles::where('twitter_id',$id)->first();
        if(empty($article)){
            $article = new Articles();
            $article->twitter_id = $id;
            $article->content = $text;
            $article->title = $title;
            $article->image = $image_link;
            $article->created_at = $created_at;
            $article->date = $created_at;
            $article->category_id = 1;
            $article->status = 'PUBLISHED';
            try {
                $article->save();
                echo $id." done"."<br>";
            }catch(\Exception $e) {
                echo $id." failed"."<br>";
                echo $e->getMessage();
            }
        }
    }

}
