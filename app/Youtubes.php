<?php
//sd
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Tags
 * @package App
 */
class Youtubes extends Model
{
    /**
     * @param $tag_ids
     * @return Collection
     */

    public static function getPdf($slug)
    {
        return Pdfs::where('slug', 'LIKE', "%{$slug}%")->first();
    }
}
