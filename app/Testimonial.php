<?php
//#SID - 46-testimonials-slider-section-for-the-homepage
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Tags
 * @package App
 */
class Testimonial extends Model
{
    /**
     * @param $tag_ids
     * @return Collection
     */

    public static function getPdf($slug)
    {
        return Testimonials::where('slug', 'LIKE', "%{$slug}%")->first();
    }
}
