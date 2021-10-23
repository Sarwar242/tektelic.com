<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_category';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
//    protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    public function articles()
    {
        return $this->belongsToMany('App\Models\Models\Article', 'article_category');
    }
}

