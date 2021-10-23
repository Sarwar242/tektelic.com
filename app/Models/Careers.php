<?php
//#SID - #z3c3nz - Career page On Tektelic
namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Career;
// use Cviebrock\EloquentSluggable\Sluggable;
// use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

/**
 * Class Articles
 * @package App\Models
 */
class Careers extends Career
{
    use CrudTrait;
    //use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'careers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['short_description', 'link'];
    // protected $hidden = [];
    // protected $dates = [];
//     protected $casts = [
//         'featured'  => 'boolean',
// //        'date'      => 'date',
//     ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    // public function sluggable()
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'slug_or_title',
    //         ],
    //     ];
    // }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // public function categories()
    // {
    //     return $this->belongsToMany('App\Models\Category', 'article_category');
    // }

    // public function tags()
    // {
    //     return $this->belongsToMany('App\Models\Tag', 'article_tag');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function keys()
    // {
    //     return $this->belongsToMany('App\Models\Keys');
    // }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'PUBLISHED')
    //         ->where('date', '<=', date('Y-m-d'))
    //         ->orderBy('date', 'DESC');
    // }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
