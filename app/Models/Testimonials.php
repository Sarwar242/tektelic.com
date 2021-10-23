<?php
//#SID - 46-testimonials-slider-section-for-the-homepage
namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Testimonial;
// use Cviebrock\EloquentSluggable\Sluggable;
// use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

/**
 * Class Articles
 * @package App\Models
 */
class Testimonials extends Testimonial
{
    use CrudTrait;
    //use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = ['company_name', 'logo', 'speaker_name', 'position', 'quote', 'website_link'];
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

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        // if ($this->slug != '') {
        //     return $this->slug;
        // }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
